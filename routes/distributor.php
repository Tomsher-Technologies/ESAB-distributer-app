<?php

use App\Http\Controllers\Distributor\DistributorDashboardController;
use App\Http\Controllers\Distributor\ProductsController;
use App\Http\Controllers\Distributor\UploadController;
use App\Http\Livewire\Distributor\ProductHistory;
use App\Http\Livewire\Distributor\Products;
use App\Models\Product\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'distributor', 'as' => 'distributor.'], function () {
    Route::get('/', function () {
        // $request = Request::with(['fromDistributor', 'toDistributor', 'product'])->find(6);
        // return new App\Mail\NewRequest($request);

        return redirect()->route('distributor.dashboard');
    });
    Route::middleware(['auth', 'auth.session', 'distributor'])->group(function () {
        Route::get('dashboard', [DistributorDashboardController::class, 'index'])->name('dashboard');
        Route::post('dashboard', [DistributorDashboardController::class, 'index'])->name('dashboard');

        Route::get('products', Products::class)->name('products');
        Route::post('product/request', [DistributorDashboardController::class, 'request'])->name('product.request');
        Route::get('product/getLot', [DistributorDashboardController::class, 'getLots'])->name('product.getLot');

        Route::get('upload/manual', [UploadController::class, 'manualView'])->name('uploads.manual');

        Route::get('upload/excel', [UploadController::class, 'excelView'])->name('uploads.excel');
        Route::post('upload/excel', [UploadController::class, 'excelUpload']);

        Route::get('upload/history', ProductHistory::class)->name('uploads.history');
    });
});
