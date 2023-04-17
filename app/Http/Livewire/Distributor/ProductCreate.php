<?php

namespace App\Http\Livewire\Distributor;

use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductCreate extends Component
{
    public $gins;

    public Collection $inputs;
    public $lots = [];
    public $cur_lot = [];

    protected $rules = [
        'inputs.*.gin' => 'required',
        'inputs.*.lot' => 'required',
        'inputs.*.avg_sale' => 'required',
        'inputs.*.over_stock' => 'required',
        'inputs.*.stock_transit' => 'required',
        'inputs.*.stock_hand' => 'required',
        'inputs.*.stock_order' => 'required',
    ];

    protected $messages = [
        'inputs.*.gin.required' => 'Please select a GIN.',
        'inputs.*.lot.required' => 'Please select a lot.',
        'inputs.*.avg_sale.required' => 'Please enter average sales per month.',
        'inputs.*.over_stock.required' => 'Please enter ',
        'inputs.*.stock_transit.required' => 'Please enter Goods in Transit',
        'inputs.*.stock_hand.required' => 'Please enter Stock on Hand',
        'inputs.*.stock_order.required' => 'Please select over stock status',
    ];

    public function mount()
    {
        $this->gins = Product::whereStatus(1)->get();
        // $this->add(0);
        $this->fill([
            'inputs' => collect([
                [
                    'gin' => null,
                    'lot' => null,
                    'avg_sale' => null,
                    'over_stock' => null,
                    'stock_transit' => null,
                    'stock_hand' => null,
                    'stock_order' => null,
                ]
            ]),
        ]);
    }

    public function addInput()
    {
        $this->inputs->push([
            'gin' => null,
            'lot' => null,
            'avg_sale' => null,
            'over_stock' => null,
            'stock_transit' => null,
            'stock_hand' => null,
            'stock_order' => null,
        ]);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function save()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.distributor.product-create');
    }

    public function changeGin($key)
    {
        $this->lots[$key] = [];
        $id = $this->inputs[$key]['gin'];
        $cur = $this->gins->find($id);
        $lot = $this->gins->where('GIN', $cur->GIN)->all();
        $index = 0;
        foreach ($lot as  $l) {
            if ($index == 0) {
                $this->cur_lot[$key] = $l;
            }
            $this->lots[$key][] = $l;
            $index++;
        }
    }

    public function changeLot($key, $value)
    {
        $cur = $this->gins->find($value);
        $this->cur_lot[$key] = $cur;
    }

    public function getValue($key, $type)
    {
        if (array_key_exists($key, $this->cur_lot)) {

            if (is_array($this->cur_lot[$key])) {
                return $this->cur_lot[$key][$type];
            }

            return $this->cur_lot[$key]->$type ?? '';
        }

        return "";
    }
}
