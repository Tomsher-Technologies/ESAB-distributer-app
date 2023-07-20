<?php

namespace App\Http\Livewire\Admin;

use App\Models\Distributor\Distributor;
use App\Models\Product\Product;
use App\Models\Product\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Bouncer;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AdminRequest extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $gins;
    public $distributors;

    // Form variables
    public $date;
    public $from = array('all');
    public $to = array('all');
    public $gin = array('all');
    public $status = array('all');

    public $showReset = 0;

    public function mount()
    {
        if (Bouncer::cannot('view-request')) {
            abort(404);
        }

        $this->gins = Product::select(['id', 'GIN'])->get();
        $this->distributors = User::whereIs('distributor')->select(['id', 'name'])->get();
    }

    public function markCompleted($id)
    {
        Request::whereId($id)->update(['status' => 2]);
        $this->dispatchBrowserEvent('created');
    }

    public function markRejected($id)
    {
        Request::whereId($id)->update(['status' => 3]);
        $this->dispatchBrowserEvent('created');
    }

    public function render()
    {
        DB::enableQueryLog();

        $query = Request::latest();

        $distributor_id = [];

        if (!Auth::user()->isAn('admin')) {
            // $query->whereHas('fromDistributor.distributor', function ($q) {
            //     return $q->where('manager_id', Auth::user()->id);
            // });

            $distributors = Distributor::where('manager_id', Auth::user()->id)->select('user_id')->get();

            if ($distributors) {
                foreach ($distributors as $distributor) {
                    $distributor_id[] = $distributor->user_id;
                }
            }

            $query->whereIn('from_distributor', $distributor_id)->orWhereIn('to_distributor', $distributor_id);
        }

        if ($this->date !== '' && $this->date !== null) {
            $start = Carbon::parse($this->date)->startOfDay();
            $end = Carbon::parse($this->date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);

            $this->showReset = 1;
        }

        if (!in_array('all', $this->from)) {
            $from = $this->from;
            $query->whereHas('fromDistributor', function ($q) use ($from) {
                return $q->where('id', $from);
            });
            $this->showReset = 1;
        }

        if (!in_array('all', $this->to)) {
            $to = $this->to;
            $query->whereHas('toDistributor', function ($q) use ($to) {
                return $q->where('id', $to);
            });
            $this->showReset = 1;
        }

        if (!in_array('all', $this->gin)) {
            $gin = $this->gin;
            $query->whereHas('product', function ($q) use ($gin) {
                return $q->where('id', $gin);
            });
            $this->showReset = 1;
        }

        if (!in_array('all', $this->status)) {
            $query->where('status', $this->status);
            $this->showReset = 1;
        }

        $requests =  $query->with([
            'fromDistributor',
            'toDistributor',
            'product',
        ])->paginate(15);


        return view('livewire.admin.admin-request')
            ->extends('admin.layouts.app', ['body_class' => ''])
            ->with([
                'requests' => $requests,
                'distributor_id' => $distributor_id,
            ]);
    }

    public function resetForm()
    {
        $this->reset([
            'date',
            'from',
            'to',
            'gin',
            'status',
            'showReset',
        ]);
    }
}
