<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Bouncer;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $deleteid;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        if (Bouncer::cannot('view-products')) {
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
            Product::destroy($this->deleteid);
            $this->dispatchBrowserEvent('deleted');
        }
        $this->reset('deleteid');
    }

    public function render()
    {
        $query = Product::latest();

        if ($this->search !== "") {
            $search = trim($this->search);
            $query->where('GIN', 'LIKE', '%' . $search . '%')
                ->orWhere('lot_no', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('UOM', 'LIKE', '%' . $search . '%')
                ->orWhere('category', 'LIKE', $search);
        }

        $products = $query->paginate(15);

        return view('livewire.admin.products.index')->with([
            'products' => $products
        ]);

        // return view('livewire.admin.products.index');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
