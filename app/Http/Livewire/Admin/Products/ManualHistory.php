<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Distributor\ManualHistory as DistributorManualHistory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Bouncer;
use Illuminate\Support\Facades\Auth;

class ManualHistory extends Component
{
    use WithPagination;

    public $form_start_date = "";
    public $form_end_date = "";

    public $deleteid;

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
        $query = DistributorManualHistory::where([
            'user_id' => Auth::user()->id
        ])->latest();

        if ($this->start_date !== "") {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }

        $uploads = $query->with(['product'])->paginate(30);

        return view('livewire.admin.products.manual-history')
            ->extends('distributor.layouts.app', [
                'body_class' => ""
            ])->with([
                'uploads' => $uploads
            ]);
    }

    public function deleteRecord()
    {
        if ($this->deleteid !== 0 || $this->deleteid !== "0" || $this->deleteid !== null) {
            $upload = DistributorManualHistory::find($this->deleteid);
            $upload->delete();
            $this->dispatchBrowserEvent('deleted');
            $this->render();
        }
        $this->reset('deleteid');
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
