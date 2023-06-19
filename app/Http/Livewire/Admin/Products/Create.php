<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Country;
use App\Models\Product\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{

    public $gin;
    // public $lot_no;
    public $description;
    public $uom;
    public $category = 'FM';
    // public $country = 'AE';

    // public $countries;

    protected function rules()
    {
        return [
            'gin' => 'required',
            // 'lot_no' => 'required',
            'description' => 'nullable',
            'uom' => ['required'],
            // 'country' => ['required'],
            'category' => ['required', Rule::notIn(['0']),],
        ];
    }

    protected $messages = [
        'gin.required' => 'Please enter a GIN',
        'lot_no.required' => 'Please enter a lot number',
        'uom.required' => 'Please enter a UOM',
        'country.required' => 'Please select a country',
        'category.required' => 'Please select a category',
        'category.not_in' => 'Please select a category',
        'status.required' => 'Please select a status',
    ];

    // public function mount(){
    //     $this->countries = Country::all();
    // }

    public function save()
    {
        $this->validate();

        $product = Product::create([
            'GIN' => $this->gin,
            'lot_no' => null,
            'description' => $this->description,
            'UOM' => $this->uom,
            'country_code' => 'AE',
            'category' => $this->category,
            'status' => 1,
        ]);

        $this->reset([
            'gin',
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
