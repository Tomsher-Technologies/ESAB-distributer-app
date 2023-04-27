<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Roles\RolesController;
use App\Http\Controllers\Admin\Distributor\DistributorController;
use App\Http\Livewire\Admin\AdminRequest;
use App\Http\Livewire\Admin\Roles\RoleCreate;
use App\Http\Livewire\Admin\Roles\RoleEdit;
use App\Http\Livewire\Admin\Roles\RoleIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => env('ADMIN_PREFIX', 'admin'), 'as' => 'admin.'], function () {
    Route::get('/', function () {
        // dd( auth()->user()->can('manage-distributor') );
        return redirect()->route('admin.dashboard');
    });
    Route::middleware(['auth', 'auth.session', 'admin'])->group(function () {
        // Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('dashboard/download', function () {
            return redirect()->route('admin.dashboard');
        })->name('dashboard.download');
        Route::post('dashboard/download', [DashboardController::class, 'download'])->name('dashboard.download');

        Route::get('settings', [DashboardController::class, 'settingsView'])->name('settings');
        Route::post('settings', [DashboardController::class, 'settings'])->name('settings ');

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('/', RoleIndex::class)->name('index');
            Route::get('/create', RoleCreate::class)->name('create');
            Route::get('/{role}/edit', RoleEdit::class)->name('edit');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');

            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::post('/{user}/edit', [AdminUserController::class, 'update']);
        });

        Route::resource('distributor', DistributorController::class)->only(['index', 'create', 'edit']);

        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::get('/import', [ProductController::class, 'importView'])->name('import');
            Route::post('/import', [ProductController::class, 'import']);
            Route::get('/history', [ProductController::class, 'history'])->name('history');
        });
        Route::resource('products', ProductController::class)->only(['index', 'create', 'edit']);

        Route::get('/requests', AdminRequest::class)->name('requests');
    });
});
