@extends('layouts.admin')

@section('title', 'Manage Transactions')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-200">Transactions</h1>
        <a href="{{ route('admin.reports.transactions') }}" class="bg-amber-500 text-gray-900 px-4 py-2 rounded-md hover:bg-amber-600">
            <i class="fas fa-chart-bar mr-2"></i>View Report
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-800 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-amber-500 bg-opacity-20">
                    <i class="fas fa-dollar-sign text-2xl text-amber-500"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-400 text-sm">Total Sales</h2>
                    <p class="text-2xl font-bold text-amber-500">${{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-amber-500 bg-opacity-20">
                    <i class="fas fa-shopping-cart text-2xl text-amber-500"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-400 text-sm">Total Transactions</h2>
                    <p class="text-2xl font-bold text-amber-500">{{ $totalTransactions }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-200">#{{ $transaction->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-200">{{ $transaction->user->name }}</div>
                            <div class="text-sm text-gray-400">{{ $transaction->user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-200">{{ $transaction->book->title }}</div>
                            <div class="text-sm text-gray-400">By {{ $transaction->book->author }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-amber-500">${{ number_format($transaction->amount, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ $transaction->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.transactions.show', $transaction) }}" class="text-amber-500 hover:text-amber-600">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
</div>
@endsection 