<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class  UploadController extends Controller
{
    public function manualView()
    {
        // $gins = Product::whereStatus(1)->get();
        return view('distributor.uploads.manual');
    }
    public function manualUpload(Request $request)
    {
        dd($request);
    }
    public function excelView()
    {
        return view('distributor.uploads.excel');
    }
    public function excelUpload(Request $request)
    {
    }
    public function history()
    {
        return view('distributor.uploads.history');
    }
}
