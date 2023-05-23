<?php

namespace App\Http\Livewire\Distributor;

use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $selected_gin =  array('all');
    public $category = 'all';
    public $overstocked = 'all';
    public $start_date;
    public $end_date;

    public $show_clear = 0;

    public $gins;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->gins =  DistributorProduct::where('user_id', Auth()->user()->id)->latest()->with('product')->get();
    }

    public function render()
    {
        $query = DistributorProduct::where('user_id', Auth()->user()->id)->latest();

        $this->show_clear = 0;

        if (!in_array('all', $this->selected_gin)) {
            // dd($this->selected_gin);

            $selected_gin = $this->selected_gin;
            $query->whereHas('product', function ($q) use ($selected_gin) {
                return $q->whereIn('id', $selected_gin);
            });

            // $query->whereRelation('product', 'id', $this->selected_gin);
            $this->show_clear = 1;
        }

        if ($this->overstocked !== 'all') {
            $query->where('overstocked', $this->overstocked);
            $this->show_clear = 1;
        }

        if ($this->category !== 'all') {
            $query->whereRelation('product', 'category', $this->category);
            $this->show_clear = 1;
        }

        if ($this->start_date !== '' && $this->start_date !== null) {
            $this->end_date = $this->end_date ?? $this->start_date;

            $start_date = Carbon::parse($this->start_date)->startOfDay();
            $end_date = Carbon::parse($this->end_date)->endOfDay();

            $query->whereBetween('created_at', [$start_date, $end_date]);

            $this->show_clear = 1;
        }

        

        $products = $query->with('product')->paginate(15);

        return view('livewire.distributor.products')
            ->with([
                'products' => $products
            ])->extends('distributor.layouts.app', ['body_class' => '']);
    }

    public function clearForm()
    {
        $this->show_clear = 0;

        $this->reset([
            'selected_gin',
            'category',
            'overstocked',
            'start_date',
            'end_date',
        ]);
    }

    public function updatingSearch()
    {
        $this->end_date = $this->end_date ?? $this->start_date;
        $this->resetPage();
    }
}
