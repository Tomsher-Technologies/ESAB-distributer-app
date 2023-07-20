<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Silber\Bouncer\Database\Role;
use Bouncer;

class Edit extends Component
{

    public $user;
    public $roles;
    public $role;
    public $user_role;
    public $password;
    public $password_confirmation;

    public function mount(User $user)
    {
        if (Bouncer::cannot('manage-users')) {
            abort(404);
        }
        $this->user = $user;
        $this->roles = Role::where('name', '!=', 'distributor')->get();
        $this->user_role = $user->getRoles();
        $this->role = $this->user_role[0];
    }

    protected function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => ['nullable', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'user.status' => ['required'],
            'role' => ['required'],
        ];
    }

    protected $messages = [
        'password.required' => 'Please enter a password',
        'name.required' => 'Please enter a name',
        'email.email' => 'The email address format is not valid.',
        'email.unique' => 'The email is already take, please use another email.',
        'email.required' => 'The email address is required.',
        'password_confirmation.same' => 'The password confirmation does not match.',
    ];

    public function save()
    {
        $this->validate();

        if ($this->password !== null) {
            $this->user->password = $this->password;
            $this->reset([
                'password_confirmation',
                'password'
            ]);
        }

        if (!in_array($this->role, $this->user_role->toArray())) {
            foreach ($this->user_role as $role) {
                $this->user->retract($role);
            }
            $this->user->assign($this->role);
            Bouncer::refresh();
        }

        $this->user->save();

        $this->dispatchBrowserEvent('created');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
