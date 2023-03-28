<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{

    public $gin;
    public $lot_no;
    public $description;
    public $uom;
    public $category = 0;

    protected function rules()
    {
        return [
            'gin' => 'required',
            'lot_no' => 'required',
            'description' => 'nullable',
            'uom' => ['required'],
            'category' => ['required', Rule::notIn(['0']),],
        ];
    }

    protected $messages = [
        'gin.required' => 'Please enter a GIN',
        'lot_no.required' => 'Please enter a lot number',
        'uom.required' => 'Please enter a UOM',
        'category.required' => 'Please select a category',
        'category.not_in' => 'Please select a category',
        'status.required' => 'Please select a status',
    ];

    public function save()
    {
        $this->validate();

        $product = Product::create([
            'GIN' => $this->gin,
            'lot_no' => $this->lot_no,
            'description' => $this->description,
            'UOM' => $this->uom,
            'category' => $this->category,
            'status' => 1,
        ]);

        $this->reset([
            'gin',
            'lot_no',
            'description',
            'uom',
            'category',
        ]);

        $this->dispatchBrowserEvent('created');
    }

    public function render()
    {
        return view('livewire.admin.products.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
