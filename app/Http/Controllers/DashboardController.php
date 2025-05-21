<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect('/admin/dashboard');
        }
        return redirect('/books');
    }

    public function adminDashboard()
    {
        // Middleware admin already checks if user is admin, so no need to check again
        
        $data = [
            'totalUsers' => User::count(),
        ];
        
        return view('admin.dashboard', $data);
    }
}
