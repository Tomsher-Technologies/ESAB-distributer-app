<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;
use Bouncer;
use Illuminate\Support\Facades\DB;

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

        $abilities = Ability::all();;

        DB::table('permissions')->where('entity_id', $this->role->id)->delete();

        foreach ($this->selectpermission as $selectpermission) {

            Bouncer::allow($this->role)->to($selectpermission);

            // $id = $abilities->where('name', $selectpermission)->first()->id;
            // if ($id) {
            //     DB::table('permissions')->insert([
            //         'ability_id' => $id,
            //         'entity_id' => $this->role->id,
            //         'entity_type' => 'role',
            //         'forbidden' => 0,
            //         'scope' => null
            //     ]);
            // }
        }
        $this->role->save();
        Bouncer::refresh();
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
