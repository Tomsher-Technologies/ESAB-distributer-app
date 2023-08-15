<?php

namespace App\Http\Livewire\Distributor;

use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\Rule;

class ProductCreate extends Component
{
    public $gins;

    public Collection $inputs;
    // public $lots = [];
    public $cur_lot = [];

    protected function rules()
    {
        return [
            'inputs.*.gin' => [
                'required',
                Rule::notIn(['0'])
            ],
            // 'inputs.*.lot' => [
            //     Rule::notIn(['0'])
            // ],
            // 'inputs.*.avg_sale' => 'required',
            'inputs.*.over_stock' => [
                'required',
                Rule::notIn(['3'])
            ],
            // 'inputs.*.stock_transit' => 'required',
            // 'inputs.*.stock_hand' => 'required',
            // 'inputs.*.stock_order' => 'required',
        ];
    }

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
        // $this->gins = Product::whereStatus(1)->limit(100)->get();
        // $this->add(0);
        $this->fill([
            'inputs' => collect([
                [
                    'gin' => 0,
                    'lot' => null,
                    'avg_sale' => null,
                    'over_stock' => 3,
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
            'over_stock' => 3,
            'stock_transit' => null,
            'stock_hand' => null,
            'stock_order' => null,
        ]);

        $this->emit('added_new_row');
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function save()
    {
        $this->validate();

        $user_id = Auth()->user()->id;

        if (count($this->inputs)) {
            foreach ($this->inputs as $inputs) {
                DistributorProduct::updateOrCreate([
                    'user_id' => $user_id,
                    'lot_number' => $inputs['lot'],
                    'product_id' => $inputs['gin'],
                ], [
                    'stock_on_hand' => $inputs['stock_hand'],
                    'goods_in_transit' => $inputs['stock_transit'],
                    'stock_on_order' => $inputs['stock_order'],
                    'avg_sales' => $inputs['avg_sale'],
                    'overstocked' => $inputs['over_stock'],
                ]);
            }

            // $this->reset(['lots', 'cur_lot']);
            foreach ($this->inputs as $key => $inputs) {
                $this->removeInput($key);
            }

            $this->fill([
                'inputs' => collect([
                    [
                        'gin' => 0,
                        'lot' => null,
                        'avg_sale' => null,
                        'over_stock' => 3,
                        'stock_transit' => null,
                        'stock_hand' => null,
                        'stock_order' => null,
                    ]
                ]),
            ]);

            $this->dispatchBrowserEvent('created');
        } else {
            $this->dispatchBrowserEvent('empty');
        }
    }

    public function render()
    {
        return view('livewire.distributor.product-create');
    }

    // public function changeGin($key)
    // {
    //     $this->lots[$key] = [];
    //     $id = $this->inputs[$key]['gin'];
    //     $cur = $this->gins->find($id);
    //     $lot = $this->gins->where('GIN', $cur->GIN)->all();
    //     $index = 0;
    //     foreach ($lot as  $l) {
    //         if ($index == 0) {
    //             $this->cur_lot[$key] = $l;
    //             // $this->inputs[$key]['lot'] = $l;
    //         }
    //         $this->lots[$key][] = $l;
    //         $index++;
    //     }

    //     $this->inputs = $this->inputs->map(function ($object, $index) use ($key, $l) {
    //         if ($index == $key) {
    //             $object['lot'] = $this->cur_lot[$key]->id;
    //         }
    //         return $object;
    //     });
    // }

    public function changeLot($key, $value)
    {
        $cur = Product::whereStatus(1)->whereId($value)->get()->first();
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
