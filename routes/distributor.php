<?php

use App\Http\Controllers\Distributor\DistributorDashboardController;
use App\Http\Controllers\Distributor\ProductsController;
use App\Http\Controllers\Distributor\UploadController;
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
        return redirect()->route('distributor.dashboard');
    });
    Route::middleware(['auth', 'auth.session', 'distributor'])->group(function () {
        Route::get('dashboard', [DistributorDashboardController::class, 'index'])->name('dashboard');
        Route::post('dashboard', [DistributorDashboardController::class, 'index'])->name('dashboard');

        Route::get('products', [ProductsController::class, 'index'])->name('products');

        Route::get('upload/manual', [UploadController::class, 'manualView'])->name('uploads.manual');
        Route::post('upload/manual', [UploadController::class, 'manualUpload']);

        Route::get('upload/excel', [UploadController::class, 'excelView'])->name('uploads.excel');
        Route::post('upload/excel', [UploadController::class, 'excelUpload']);

        Route::get('upload/history', [UploadController::class, 'history'])->name('uploads.history');
    });
});
