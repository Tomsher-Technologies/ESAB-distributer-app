<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Bouncer;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Str;

class RoleCreate extends Component
{

    public $name;
    public $selectpermission = array();

    public $permissions;

    protected function rules()
    {
        return [
            'name' => 'required|unique:roles,title',
            'selectpermission' => 'required'
        ];
    }

    protected $messages = [
        'name.unique' => 'A role with the same name already exists',
        'name.required' => 'Please enter a name',
        'selectpermission.required' => 'Please select some permissions',
    ];

    public function mount()
    {
        $this->permissions = Ability::where('title', '!=', 'All simple abilities')->get();
    }

    public function save()
    {
        $this->validate();

        $role = Role::create([
            'name' => Str::lower(Str::slug($this->name, '-')),
            'title' => $this->name,
        ]);

        foreach ($this->selectpermission as $permission) {
            Bouncer::allow($role)->to($permission);
        }

        $this->reset('name');
        $this->reset('selectpermission');

        Bouncer::refresh();

        $this->dispatchBrowserEvent('created');
    }

    public function render()
    {
        return view('livewire.admin.roles.role-create')
            ->extends('admin.layouts.app', ['body_class' => ""]);
    }

    public function updated($propertyName)
    {
        // $this->validateOnly($propertyName);
    }
}
