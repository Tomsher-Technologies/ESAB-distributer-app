<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $deleteid;

    protected $paginationTheme = 'bootstrap';

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
            $user =  User::whereIsNot('distributor')->where('id', $this->deleteid)->get()->first();
            $user->delete();
            $this->dispatchBrowserEvent('deleted');
        }
        $this->reset('deleteid');
    }

    public function render()
    {
        $query = User::latest();

        if ($this->search !== "") {
            $search = trim($this->search);
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        $users = $query
            ->whereIsNot('distributor')
            ->paginate(10);

        return view('livewire.admin.users.index')->with([
            'users' => $users
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
