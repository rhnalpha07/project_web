@extends('layouts.admin')

@section('title', 'Transaction Reports')

@section('styles')
<style>
    .stat-card {
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .date-picker {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .date-picker:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #f59e0b;
    }
    @media print {
        .no-print {
            display: none;
        }
        .print-only {
            display: block;
        }
        body {
            background: white;
            color: black;
        }
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-200 mb-2">Transaction Reports</h1>
            <p class="text-gray-400">Analyze your sales and transaction data</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
            <button onclick="window.print()" class="bg-gray-700 text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center justify-center no-print">
                <i class="fas fa-print mr-2"></i>Print Report
            </button>
            <a href="{{ route('admin.transactions.index') }}" class="bg-amber-500 text-gray-900 px-4 py-2 rounded-lg hover:bg-amber-600 flex items-center justify-center no-print">
                <i class="fas fa-arrow-left mr-2"></i>Back to Transactions
            </a>
        </div>
    </div>

    <!-- Date Filter -->
    <div class="bg-gray-800 rounded-lg p-6 mb-6 no-print">
        <form action="{{ route('admin.reports.transactions') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-400 mb-1">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                    class="date-picker px-4 py-2 rounded-lg text-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-400 mb-1">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                    class="date-picker px-4 py-2 rounded-lg text-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <div>
                <button type="submit" class="bg-amber-500 text-gray-900 px-6 py-2 rounded-lg hover:bg-amber-600 flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Apply Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Print Header -->
    <div class="hidden print-only mb-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-2">Transaction Report</h1>
            <p class="text-gray-600">{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="stat-card bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-dollar-sign text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">Total Sales</h2>
                    <p class="text-2xl font-bold text-white">${{ number_format($statistics['total_sales'], 2) }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-shopping-cart text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">Total Transactions</h2>
                    <p class="text-2xl font-bold text-white">{{ $statistics['total_transactions'] }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-chart-line text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">Average Transaction</h2>
                    <p class="text-2xl font-bold text-white">${{ number_format($statistics['average_transaction'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="bg-gray-800 rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-200 mb-4">Daily Sales Trend</h2>
        <canvas id="salesChart" class="w-full" style="height: 300px;"></canvas>
    </div>

    <!-- Transactions Table -->
    <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-400">{{ $transaction->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">{{ strtoupper(substr($transaction->user->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm text-gray-200">{{ $transaction->user->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $transaction->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-200">{{ $transaction->book->title }}</div>
                            <div class="text-xs text-gray-400">By {{ $transaction->book->author }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-amber-500">${{ number_format($transaction->amount, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesData = @json($statistics['sales_by_day']);
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: Object.keys(salesData),
            datasets: [{
                label: 'Daily Sales',
                data: Object.values(salesData),
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#f59e0b',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#f59e0b'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af',
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#9ca3af'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Sales: $' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection 