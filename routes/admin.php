<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Distributor\DistributorController;
use App\Models\Distributor\Distributor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => env('ADMIN_PREFIX', 'admin'), 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::middleware(['guest'])->group(function () {
        Route::get('login', [LoginController::class, 'loginView'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate']);
    });
    Route::middleware(['auth', 'auth.session', 'admin'])->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile');
            Route::post('/', [ProfileController::class, 'update'])->name('update');
            Route::post('/password', [ProfileController::class, 'password'])->name('password');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');

            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::post('/{user}/edit', [AdminUserController::class, 'update']);
        });

        Route::resource('distributor', DistributorController::class);

        Route::resource('products', ProductController::class);
    });
});
