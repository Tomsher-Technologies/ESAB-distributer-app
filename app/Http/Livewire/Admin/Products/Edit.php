<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    protected function rules()
    {
        return [
            'product.GIN' => 'required',
            'product.lot_no' => 'required',
            'product.description' => 'nullable',
            'product.UOM' => ['required'],
            'product.category' => ['required', Rule::notIn(['0']),],
        ];
    }

    protected $messages = [
        'product.GIN.required' => 'Please enter a GIN',
        'product.lot_no.required' => 'Please enter a lot number',
        'product.UOM.required' => 'Please enter a UOM',
        'product.category.required' => 'Please select a category',
        'product.category.not_in' => 'Please select a category',
        'product.status.required' => 'Please select a status',
    ];

    public function save()
    {
        $this->validate();
        $this->product->save();
        $this->dispatchBrowserEvent('updated');
    }

    public function render()
    {
        return view('livewire.admin.products.edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
