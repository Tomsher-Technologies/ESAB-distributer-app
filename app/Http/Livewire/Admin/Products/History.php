<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Upload;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public $form_start_date = "";
    public $form_end_date = "";

    public $start_date = "";
    public $end_date = "";

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'form_start_date' => 'required',
            'form_end_date' => 'sometimes',
        ];
    }

    protected $messages = [
        'form_start_date.required' => 'Please select start date',
    ];

    public function filter()
    {
        $this->validate();

        $this->start_date = Carbon::parse($this->form_start_date)->startOfDay();
        $this->form_end_date = $this->form_end_date !== "" ? $this->form_end_date : $this->form_start_date;
        $this->end_date = Carbon::parse($this->form_end_date)->endOfDay();
    }

    public function render()
    {
        $query = Upload::latest();

        if ($this->start_date !== "") {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }

        $uploads = $query->with(['user'])->paginate(10);

        return view('livewire.admin.products.history')
            ->with([
                'uploads' => $uploads
            ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFormStartDate()
    {
        $this->form_end_date = $this->form_end_date !== "" ? $this->form_end_date : $this->form_start_date;
    }
}
