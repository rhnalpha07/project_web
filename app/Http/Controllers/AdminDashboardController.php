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
        // Total counts for statistics cards
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalOrders = Transaction::count();
        $totalRevenue = Transaction::sum('amount');

        // Recent orders
        $recentOrders = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                // Add items count and status color
                $order->items_count = 1; // Assuming 1 book per transaction based on the model
                $order->status_color = $this->getStatusColor($order->status);
                return $order;
            });

        // Top selling books with transaction count
        $topBooks = Book::withCount(['transactions as sales_count'])
            ->orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        // Sales statistics by month for chart
        $statistics = [
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

        return view('admin.dashboard', compact(
            'totalBooks', 
            'totalUsers', 
            'totalOrders', 
            'totalRevenue', 
            'recentOrders', 
            'topBooks', 
            'statistics'
        ));
    }

    private function getStatusColor($status)
    {
        return match ($status) {
            'completed' => 'success',
            'pending' => 'warning',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
} 