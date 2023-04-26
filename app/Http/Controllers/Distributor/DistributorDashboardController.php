<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
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
        $products = $query->with(['product', 'product.country'])->get();

        // dd($products);

        $gins = Product::whereStatus(true)->select('GIN')->latest()->get();

        return view('distributor.dashboard', compact('countries', 'gins', 'products', 'request'));
    }
}
