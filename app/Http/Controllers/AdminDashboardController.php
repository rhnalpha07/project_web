<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $statistics = [
            'total_users' => User::count(),
            'total_books' => Book::count(),
            'total_sales' => Transaction::sum('amount'),
            'total_transactions' => Transaction::count(),
            'recent_transactions' => Transaction::with(['user', 'book'])
                ->latest()
                ->take(5)
                ->get(),
            'sales_by_month' => Transaction::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray()
        ];

        return view('admin.dashboard', compact('statistics'));
    }
} 