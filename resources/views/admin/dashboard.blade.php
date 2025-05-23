@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    .stat-card {
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Stats Cards Row -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--primary-color);">
                    <i class="fas fa-users"></i>
                </div>
                <h3>{{ number_format($statistics['total_users']) }}</h3>
                <p>Total Users</p>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--success-color);">
                    <i class="fas fa-book"></i>
                </div>
                <h3>{{ number_format($statistics['total_books']) }}</h3>
                <p>Total Books</p>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--info-color);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>{{ number_format($statistics['total_transactions']) }}</h3>
                <p>Total Transactions</p>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--warning-color);">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>${{ number_format($statistics['total_sales'], 2) }}</h3>
                <p>Total Sales</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Transactions -->
        <div class="col-12 col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Transactions</h5>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Book</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statistics['recent_transactions'] as $transaction)
                                <tr>
                                    <td>#{{ $transaction->id }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->book->title }}</td>
                                    <td>${{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Sales Chart -->
        <div class="col-12 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Sales</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    
    const salesData = @json($statistics['sales_by_month']);
    const chartData = months.map((month, index) => salesData[index + 1] || 0);
    
    const ctx = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Sales ($)',
                data: chartData,
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush 