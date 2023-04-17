<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Imports\Admin\ProductImport;
use App\Models\Product\Product;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit')
            ->with([
                'product' => $product
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function history()
    {
        return view('admin.products.history');
    }

    public function importView()
    {
        return view('admin.products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'product_file' => 'required|file|mimetypes:text/csv,text/plain,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ], [
            'product_file.required' => "Please select a file",
            'product_file.file' => "Please select a file",
            'product_file.mimetypes' => "Please select a valid file format",
        ]);

        if ($request->hasFile('product_file')) {
            $file = $request->file('product_file');
            $name = $file->getClientOriginalName();
            $path = "public/admin_uploads/products";
            $upload = Storage::put($path, $file);

            Auth()->user()->uploads()->create([
                'name' =>  $name,
                'path' =>  str_replace('public/', 'storage/', $upload),
            ]);

            Excel::import(new ProductImport(Auth()->user()), $request->product_file);

            return back()->with([
                'status' => "File Imported"
            ]);
        }
        return back()->withErrors([
            'error' => "Something went wrong, please try again."
        ]);
    }
}
