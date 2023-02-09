<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $prefix = Route::current()->getName();

            $prefix = explode('.', $prefix)[0];

            if ($prefix == 'distributor') {
                return route('distributor.login');
            }
            if ($prefix == 'admin' || $prefix == 'manager') {
                return route('admin.login');
            }
        }
    }
}
