<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Silber\Bouncer\Database\Role;
use Bouncer;

class RoleIndex extends Component
{
    public $deleteid;


    public function mount(){
        if (Bouncer::cannot('manage-roles')) {
            abort(404);
        }
    }

    protected function rules()
    {
        return [
            'deleteid' => 'required',
        ];
    }

    public function deleteRecord()
    {
        $this->validate();
        if ($this->deleteid !== 0 || $this->deleteid !== "0") {
            $user =  Role::where('id', $this->deleteid)->get()->first();
            $user->delete();
            $this->dispatchBrowserEvent('deleted');
        }

        Bouncer::refresh();

        $this->reset('deleteid');
    }

    public function render()
    {
        $roles = Role::where('name', '!=', 'distributor')
            ->where('name', '!=', 'admin')
            ->get();

        return view('livewire.admin.roles.role-index', [
            'roles' => $roles
        ])->extends('admin.layouts.app',['body_class' => ""]);
    }
}
