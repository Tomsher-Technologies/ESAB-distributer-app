<?php

namespace App\Http\Livewire\Distributor;

use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductCreate extends Component
{
    public $gins;

    public Collection $inputs;

    public $selectd_gins;
    public $lot;
    public $avg_sale;
    public $over_stock;
    public $stock_transit;
    public $stock_hand;
    public $stock_order;


    public function mount()
    {
        $this->gins = Product::whereStatus(1)->get();
        // $this->add(0);
        $this->fill([
            'inputs' => collect([
                [
                    'gin' => 0,
                    'lot' => '',
                    'avg_sale' => '',
                    'over_stock' => '',
                    'stock_transit' => '',
                    'stock_hand' => '',
                    'stock_order' => '',
                ]
            ]),
        ]);
    }

    public function addInput()
    {
        $this->inputs->push([
            'gin' => 0,
            'lot' => '',
            'avg_sale' => '',
            'over_stock' => '',
            'stock_transit' => '',
            'stock_hand' => '',
            'stock_order' => '',
        ]);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
        // 
    }

    public function save()
    {
        dd($this->inputs);
    }

    public function render()
    {
        return view('livewire.distributor.product-create');
    }

    public function change()
    {
        // return view('livewire.distributor.product-create');
        // $this->emit('hallChanged', $value);
    }
}
