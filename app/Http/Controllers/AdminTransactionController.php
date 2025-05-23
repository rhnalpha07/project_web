<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'book'])
            ->latest()
            ->paginate(10);
            
        $totalSales = Transaction::where('status', 'completed')->sum('amount');
        $totalTransactions = Transaction::count();
        
        return view('admin.transactions.index', compact('transactions', 'totalSales', 'totalTransactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'book']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function report(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth();
        $endDate = $request->end_date ?? now();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->with(['user', 'book'])
            ->latest()
            ->get();

        $statistics = [
            'total_sales' => $transactions->where('status', 'completed')->sum('amount'),
            'total_transactions' => $transactions->count(),
            'average_transaction' => $transactions->where('status', 'completed')->avg('amount'),
            'sales_by_day' => $transactions->where('status', 'completed')
                ->groupBy(function($transaction) {
                    return $transaction->created_at->format('Y-m-d');
                })
                ->map(function($group) {
                    return $group->sum('amount');
                }),
        ];

        return view('admin.reports.transactions', compact('transactions', 'statistics', 'startDate', 'endDate'));
    }

    public function users()
    {
        $users = User::withCount(['transactions', 'carts'])
            ->withSum('transactions', 'amount')
            ->latest()
            ->paginate(10);

        $statistics = [
            'total_users' => User::count(),
            'active_users' => User::has('transactions')->count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)->count(),
            'total_revenue' => Transaction::where('status', 'completed')->sum('amount'),
        ];

        return view('admin.users.index', compact('users', 'statistics'));
    }
} 