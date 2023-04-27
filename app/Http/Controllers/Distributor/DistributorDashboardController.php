<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use App\Models\Product\Request as ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributorDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = DistributorProduct::where('overstocked', 1)->where('user_id', '!=', Auth()->user()->id)->latest();

        if ($request->search) {
            if ($request->category !== 'all') {
                $query->whereRelation('product', 'category', $request->category);
            }
            if ($request->country !== 'all') {
                $query->whereRelation('product', 'country_code', $request->country);
            }
            if ($request->gin !== 'all') {
                $query->whereRelation('product', 'GIN', $request->gin);
            }
        }

        $countries = Country::all();
        $products = $query->with(['product', 'product.country', 'product.request'])->get();

        $gins = Product::whereStatus(true)->select('GIN')->latest()->get();

        return view('distributor.dashboard', compact('countries', 'gins', 'products', 'request'));
    }

    public function request(Request $request)
    {
        $old_request = ProductRequest::where([
            'from_distributor' => Auth::user()->id,
            'to_distributor' => $request->to,
            'gin_no' => $request->id,
        ])->count();


        if ($old_request <= 0) {
            $request = ProductRequest::updateOrCreate([
                'from_distributor' => Auth::user()->id,
                'to_distributor' => $request->to,
                'gin_no' => $request->id,
            ], [
                'quantity' => $request->quantity,
                'status' => 1
            ]);

            return back()->with([
                'status' => "Request has been sent to admin"
            ]);
        }

        return back()->with([
            'error' => "You have already request for this GIN"
        ]);
    }
}
