<?php

namespace App\Http\Livewire\Distributor;

use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ProductHistory extends Component
{

    use WithPagination;

    public $form_start_date = "";
    public $form_end_date = "";

    public $start_date = "";
    public $end_date = "";

    public $deleteid;

    public $user_id;

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

    public function mount()
    {
        $this->user_id = Auth()->user()->id;
    }

    public function render()
    {
        $query = Upload::where('user_id', $this->user_id)->latest();

        if ($this->start_date !== "") {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }

        $uploads = $query->paginate(10);

        return view('livewire.distributor.product-history')
            ->with([
                'uploads' => $uploads
            ])
            ->extends('distributor.layouts.app', ['body_class' => '']);

        // return view('');
    }

    public function deleteRecord()
    {
        if ($this->deleteid !== 0 || $this->deleteid !== "0" || $this->deleteid !== null) {
            $upload = Upload::find($this->deleteid);
            $file = Str::replace('storage', 'public', $upload->path);
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
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
