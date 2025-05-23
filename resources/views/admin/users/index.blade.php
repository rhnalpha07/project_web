@extends('layouts.admin')

@section('title', 'Manage Users')

@section('styles')
<style>
    .stat-card {
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .search-box {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .search-box:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #f59e0b;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-200 mb-4 md:mb-0">Users Management</h1>
        
        <!-- Search and Filter -->
        <div class="w-full md:w-auto flex flex-col md:flex-row gap-4">
            <div class="relative">
                <input type="text" 
                       id="searchInput" 
                       placeholder="Search users..." 
                       class="search-box w-full md:w-64 px-4 py-2 rounded-lg text-gray-300 focus:outline-none">
                <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
            </div>
            <select id="filterStatus" class="bg-gray-700 text-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                <option value="all">All Users</option>
                <option value="active">Active Users</option>
                <option value="inactive">Inactive Users</option>
            </select>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="stat-card bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-users text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">Total Users</h2>
                    <p class="text-2xl font-bold text-white">{{ $statistics['total_users'] }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-user-check text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">Active Users</h2>
                    <p class="text-2xl font-bold text-white">{{ $statistics['active_users'] }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-user-plus text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">New This Month</h2>
                    <p class="text-2xl font-bold text-white">{{ $statistics['new_users_this_month'] }}</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-6 shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-dollar-sign text-2xl text-white"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-white text-sm font-medium">Total Revenue</h2>
                    <p class="text-2xl font-bold text-white">${{ number_format($statistics['total_revenue'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Joined Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Orders</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Revenue</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700" id="usersTableBody">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                                        <span class="text-white font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-200">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-400">{{ $user->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-200">{{ $user->transactions_count }}</div>
                            <div class="text-xs text-gray-400">Total Orders</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-amber-500">${{ number_format($user->transactions_sum_amount ?? 0, 2) }}</div>
                            <div class="text-xs text-gray-400">Total Spent</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->transactions_count > 0)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-amber-500 hover:text-amber-600 mr-3" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-blue-500 hover:text-blue-600 mr-3" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if($user->transactions_count === 0)
                                <button class="text-red-500 hover:text-red-600" title="Delete User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const usersTableBody = document.getElementById('usersTableBody');
    const rows = usersTableBody.getElementsByTagName('tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;

        Array.from(rows).forEach(row => {
            const name = row.querySelector('.text-gray-200').textContent.toLowerCase();
            const email = row.querySelector('.text-gray-400').textContent.toLowerCase();
            const status = row.querySelector('.rounded-full').textContent.trim().toLowerCase();
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesStatus = statusFilter === 'all' || 
                                (statusFilter === 'active' && status === 'active') ||
                                (statusFilter === 'inactive' && status === 'inactive');

            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    filterStatus.addEventListener('change', filterTable);

    // Initialize DataTable with custom styling
    $(document).ready(function() {
        $('.datatable').DataTable({
            "pageLength": 10,
            "searching": false, // We have our custom search
            "language": {
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left"></i>',
                    "next": '<i class="fas fa-chevron-right"></i>'
                }
            },
            "dom": '<"top"f>rt<"bottom"ip><"clear">'
        });
    });
</script>
@endpush
@endsection 