<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Bouncer;
use Illuminate\Support\Facades\Auth;

class Distributor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isAn('distributor')) {
            return $next($request);
        } else if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect('home')->with('error', 'Permission Denied!!! You do not have administrative access.');
    }
}