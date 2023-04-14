<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;

class RoleEdit extends Component
{

    public $role;

    public $selectpermission;

    public $permissions;
    public $abilities;

    protected function rules()
    {
        return [
            'role.title' => ['required', Rule::unique('roles', 'title')->ignore($this->role->id)],
            'selectpermission' => 'required'
        ];
    }

    protected $messages = [
        'role.title.unique' => 'A role with the same name already exists',
        'role.title.required' => 'Please enter a name',
        'selectpermission.required' => 'Please select some permissions',
    ];

    public function mount(Role $role)
    {
        $this->permissions = Ability::where('title', '!=', 'All simple abilities')->get();
        $this->role = $role;
        $this->selectpermission = $this->role->abilities->pluck('name')->toArray();
    }

    public function save()
    {
        $this->validate();


        $this->role->save();
        $this->dispatchBrowserEvent('updated');
    }

    public function render()
    {
        return view('livewire.admin.roles.role-edit')
            ->extends('admin.layouts.app', ['body_class' => ""]);;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
