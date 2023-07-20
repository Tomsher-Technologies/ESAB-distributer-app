<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Silber\Bouncer\Database\Role;
use Bouncer;

class Create extends Component
{
    public $roles;

    // Forms
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $status = 1;
    public $role = "0";


    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'status' => ['required'],
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

    public function mount()
    {
        if (Bouncer::cannot('manage-users')) {
            abort(404);
        }
        $this->roles = Role::where('name', '!=', 'distributor')->get();
        $this->role = $this->roles->first()->name;
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status,
        ]);

        $user->assign($this->role);

        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
            'status',
        ]);

        Bouncer::refresh();

        $this->dispatchBrowserEvent('created');
    }

    public function render()
    {
        return view('livewire.admin.users.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
