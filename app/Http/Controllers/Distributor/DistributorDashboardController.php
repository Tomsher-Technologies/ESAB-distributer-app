<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Mail\NewRequest;
use App\Models\Country;
use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use App\Models\Product\Request as ProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DistributorDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = DistributorProduct::where('overstocked', 1)->where('user_id', '!=', Auth()->user()->id)->latest();

        $old_lots = array();

        if ($request->search) {
            if ($request->category !== 'all') {
                $query->whereRelation('product', 'category', $request->category);
            }
            if (!in_array('all', $request->country)) {
                $country =  $request->country;
                $query->whereHas('product', function ($q) use ($country) {
                    return $q->where('country_code', $country);
                });
            }
            if (!in_array('all', $request->gin)) {
                $gin =  $request->gin;
                $query->whereHas('product', function ($q) use ($gin) {
                    return $q->where('id', $gin);
                });
            }

            if (!in_array('all', $request->lot)) {
                $query->whereIn('id', $request->lot);
            }

            $gins = Product::whereStatus(true)->select('GIN')->whereIn('id', $request->gin)->get();
            foreach ($gins as $gin) {
                $r_gins[] = $gin->GIN;
            }

            $old_lots = DistributorProduct::whereIn('product_id', $request->gin)->where('lot_number', '!=', '')->select('id', 'lot_number as lot_no')->get();
        }

        $countries = Country::all()->groupBy('region');

        $products = $query->with(['product', 'product.country', 'request'])->get();

        // $gins = Product::whereStatus(true)->select('id', 'GIN')->latest()->get();

        return view('distributor.dashboard', compact('countries', 'products', 'request', 'old_lots'));
    }

    public function request(Request $request)
    {
        $request = ProductRequest::create([
            'from_distributor' => Auth::user()->id,
            'to_distributor' => $request->to,
            'gin_no' => $request->id,
            'lot_number' => "",
            'quantity' => $request->quantity,
            'status' => 1,
        ]);

        $tracking_number = 'REQ-' . Auth::user()->id . $request->to . $request->id . '-' . $request->id;
        $request->tracking_number = $tracking_number;
        $request->save();

        $manager =  User::find(Auth::user()->distributor->manager_id);

        Mail::to($manager->email)
            ->send(new NewRequest($request));

        return back()->with([
            'status' => "Request has been sent to admin"
        ]);
    }

    public function getLots(Request $request)
    {
        $lots = DistributorProduct::whereIn('product_id', $request->selectedGins)->where('lot_number', '!=', '')->select('id', 'lot_number as lot_no')->get();
        return json_encode($lots);
    }
}
