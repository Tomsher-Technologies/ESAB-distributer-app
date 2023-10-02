<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'loginView'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->middleware(['throttle:5,1']);
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::post('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/password', [ProfileController::class, 'password'])->name('password');
    });
});

Route::get('/gins', [AjaxController::class, 'index'])->name('gins');
Route::get('/selected-gins', [AjaxController::class, 'selected_gins'])->name('selected_gins');

require_once 'distributor.php';
require_once 'admin.php';
