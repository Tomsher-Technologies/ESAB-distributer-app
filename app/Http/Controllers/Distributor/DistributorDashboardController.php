<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class DistributorDashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
        
        }
        
        $countries = Country::all();
        $gins = Product::whereStatus(true)->select('GIN')->get();
        return view('distributor.dashboard', compact('countries', 'gins'));
    }

    

}
