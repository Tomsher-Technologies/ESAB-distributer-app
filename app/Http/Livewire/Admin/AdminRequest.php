<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product\Product;
use App\Models\Product\Request;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class AdminRequest extends Component
{
    public $gins;
    public $distributors;

    // Form variables
    public $date;
    public $from = 0;
    public $to = 0;
    public $gin = 0;
    public $status = 0;

    public function mount()
    {
        $this->gins = Product::select(['id', 'GIN'])->get();
        $this->distributors = User::whereIs('distributor')->select(['id', 'name'])->get();
    }

    public function markCompleted($id)
    {
        Request::whereId($id)->update(['status' => 2]);
        $this->dispatchBrowserEvent('created');
    }

    public function render()
    {
        $query = Request::latest();

        // dd($this->date);

        if ($this->date !== '' && $this->date !== null) {
            $start = Carbon::parse($this->date)->startOfDay();
            $end = Carbon::parse($this->date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        if ($this->from !== '0' && $this->from !== 0) {
            $from = $this->from;
            $query->whereHas('fromDistributor', function ($q) use ($from) {
                return $q->where('id', $from);
            });
        }

        if ($this->to !== '0' && $this->to !== 0) {
            $to = $this->to;
            $query->whereHas('toDistributor', function ($q) use ($to) {
                return $q->where('id', $to);
            });
        }

        if ($this->gin !== '0' && $this->gin !== 0) {
            $gin = $this->gin;
            $query->whereHas('product', function ($q) use ($gin) {
                return $q->where('id', $gin);
            });
        }

        if ($this->status !== '0' && $this->status !== 0) {
            $query->where('status', $this->status);
        }

        $requests =  $query->with([
            'fromDistributor',
            'toDistributor',
            'product',
        ])->paginate(15);


        return view('livewire.admin.admin-request')
            ->extends('admin.layouts.app', ['body_class' => ''])
            ->with([
                'requests' => $requests
            ]);
    }
}
