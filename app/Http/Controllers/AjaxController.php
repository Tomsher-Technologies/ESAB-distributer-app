<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search !== null && $request->search !== "") {

            $results = array(
                'results' => Product::where('GIN', 'LIKE', '%' . $request->search . '%')->select(["id", "GIN as text"])->get()
            );

            return response()->json($results);
        }

        return null;
    }

    public function selected_gins(Request $request)
    {
        $gins = explode(',', $request->old_gin);
        $products = Product::whereIn('id', $gins)->select(["id", "GIN as text"])->get();

        return response()->json($products);
    }
}
