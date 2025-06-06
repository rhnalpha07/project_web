@extends('layouts.admin')

@section('title', 'Dasbor')

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
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-amber-500">Dasbor</h1>
        <div>
            <span class="text-gray-300">Selamat datang kembali, <span class="text-amber-500">{{ Auth::user()->name }}</span>!</span>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--primary-color)">
                    <i class="fas fa-book"></i>
                </div>
                <h3>{{ $totalBooks ?? 0 }}</h3>
                <p>Total Buku</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--success-color)">
                    <i class="fas fa-users"></i>
                </div>
                <h3>{{ $totalUsers ?? 0 }}</h3>
                <p>Total Pengguna</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--info-color)">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>{{ $totalOrders ?? 0 }}</h3>
                <p>Total Pesanan</p>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="icon" style="background-color: var(--warning-color)">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>{{ $totalRevenue ?? 0 }}</h3>
                <p>Total Pendapatan</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Top Books -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Pesanan Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Buku</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->items_count }}</td>
                                    <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status_color }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada pesanan terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Books -->
        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Buku Terlaris</h6>
                </div>
                <div class="card-body">
                    @forelse($topBooks ?? [] as $book)
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" 
                             class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                        <div class="ml-3">
                            <h6 class="mb-0 text-gray-200">{{ $book->title }}</h6>
                            <small class="text-gray-400">{{ $book->sales_count }} penjualan</small>
                        </div>
                    </div>
                    @empty
                    <p class="text-center mb-0 text-gray-400">Tidak ada data tersedia</p>
                    @endforelse
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
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    const salesData = @json($statistics['sales_by_month'] ?? []);
    const chartData = months.map((month, index) => salesData[index + 1] || 0);
    
    if (document.getElementById('monthlySalesChart')) {
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: chartData,
                    borderColor: '#d4af37', // amber-500
                    backgroundColor: 'rgba(212, 175, 55, 0.1)',
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
                                return 'Rp' + value;
                            },
                            color: '#9ca3af' // gray-400
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#9ca3af' // gray-400
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush 