<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Imports\Distributor\ProductImport;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class  UploadController extends Controller
{
    public function manualView()
    {
        return view('distributor.uploads.manual');
    }

    public function excelView()
    {
        return view('distributor.uploads.excel');
    }

    public function excelUpload(Request $request)
    {
        $request->validate([
            'product_file' => 'required|file|mimetypes:text/csv,text/plain,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ], [
            'product_file.required' => "Please select a file",
            'product_file.file' => "Please select a file",
            'product_file.mimetypes' => "Please select a valid file format",
        ]);

        $dis_code = Auth()->user()->distributor->distributer_code;

        if ($request->hasFile('product_file')) {
            $file = $request->file('product_file');
            $name = $file->getClientOriginalName();
            $path = "public/distributor_uploads/products/{$dis_code}";
            $upload = Storage::put($path, $file);

            Auth()->user()->uploads()->create([
                'name' =>  $name,
                'path' =>  str_replace('public/', 'storage/', $upload),
            ]);

            $import = new ProductImport(Auth()->user());
            Excel::import($import, $request->product_file);

            // dd($import->errors);

            if ($import->errors) {
                return back()->with([
                    'error_msg' => "There was errors in the excel, please see below.",
                    'err_array' => $import->errors
                ]);
            }

            return back()->with([
                'status' => "File Imported"
            ]);
        }

        return back()->withErrors([
            'error' => "Something went wrong, please try again."
        ]);
    }
}
