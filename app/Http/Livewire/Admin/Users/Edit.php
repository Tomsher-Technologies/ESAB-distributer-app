<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Silber\Bouncer\Database\Role;

class Edit extends Component
{

    public $user;
    public $roles;
    public $role;
    public $password;
    public $password_confirmation;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->roles = Role::where('name', '!=', 'distributor')->get();
    }

    protected function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' => ['required', 'email', Rule::unique('varieties')->ignore($this->user->id)],
            'password' => ['nullable', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'user.status' => ['required'],
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

        if ($this->password !== "") {
            $this->user->password = $this->password;
            $this->reset([
                'password_confirmation',
                'password'
            ]);
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
