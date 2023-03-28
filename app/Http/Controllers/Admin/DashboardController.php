<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $no_distributor = User::whereIs('distributor')->count();
        return view('admin.dashboard')
            ->with([
                'no_distributor' => $no_distributor,
            ]);
    }
}
