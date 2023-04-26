<?php

namespace App\Http\Livewire\Admin\Distributor;

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
            $user =  User::whereIs('distributor')->where('id', $this->deleteid)->get()->first();
            // $user->distributor()->delete();
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
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhereHas('distributor.country', function ($q) use ($search) {
                    return $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('distributor', function ($q) use ($search) {
                    return $q->where('company_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('distributer_code', 'LIKE', '%' . $search . '%')
                        ->orWhere('address', 'LIKE', '%' . $search . '%');
                });
        }

        $distributors = $query
        ->whereIs('distributor')
        ->with([
            'distributor',
            'distributor.country',
            'distributor.manager'
        ])->paginate(10);

        return view('livewire.admin.distributor.index')->with([
            'distributors' => $distributors
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
