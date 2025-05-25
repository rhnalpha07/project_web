<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'book-dark': '#131720',
                        'book-darker': '#0d111a',
                        'book-gold': '#d4af37',
                    },
                    fontFamily: {
                        'serif': ['Georgia', 'Cambria', '"Times New Roman"', 'Times', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        :root {
            --primary-color: #d4af37; /* amber-500 */
            --secondary-color: #eab308; /* amber-600 */
            --success-color: #22c55e;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827; /* gray-900 */
            color: #f3f4f6; /* gray-100 */
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: #1f2937; /* gray-800 */
            color: white;
            padding: 1rem;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1rem 0;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand h2 {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            margin-bottom: 0.5rem;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--primary-color);
        }

        .menu-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
        }

        /* Navbar */
        .top-navbar {
            background-color: #1f2937; /* gray-800 */
            border-bottom: 1px solid #374151; /* gray-700 */
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        /* Cards */
        .card {
            background-color: #1f2937; /* gray-800 */
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            border: none;
            margin-bottom: 1.5rem;
            color: #f3f4f6; /* gray-100 */
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #374151; /* gray-700 */
            padding: 1.25rem;
            color: var(--primary-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #111827; /* gray-900 */
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: #111827; /* gray-900 */
        }

        /* Tables */
        .table {
            margin-bottom: 0;
            color: #f3f4f6; /* gray-100 */
        }

        .table thead th {
            background-color: #374151; /* gray-700 */
            border-bottom: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #9ca3af; /* gray-400 */
        }

        .table td, .table th {
            border-color: #374151; /* gray-700 */
        }

        /* Stats Cards */
        .stats-card {
            background-color: #1f2937; /* gray-800 */
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease;
            color: #f3f4f6; /* gray-100 */
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card .icon {
            width: 48px;
            height: 48px;
            background-color: var(--primary-color);
            color: #111827; /* gray-900 */
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #f3f4f6; /* gray-100 */
        }

        .stats-card p {
            color: #9ca3af; /* gray-400 */
            margin: 0;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background-color: rgba(34, 197, 94, 0.2); /* success with opacity */
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.2); /* danger with opacity */
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Forms */
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #374151; /* gray-700 */
            padding: 0.75rem 1rem;
            background-color: #1f2937; /* gray-800 */
            color: #f3f4f6; /* gray-100 */
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
            background-color: #1f2937; /* gray-800 */
            color: #f3f4f6; /* gray-100 */
        }

        .form-label {
            font-weight: 500;
            color: #f3f4f6; /* gray-100 */
            margin-bottom: 0.5rem;
        }

        /* Badge */
        .bg-primary {
            background-color: var(--primary-color) !important;
            color: #111827 !important; /* gray-900 */
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-book-open mr-2"></i>BookStore</h2>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.books.index') }}" class="menu-item {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                Books
            </a>
            <a href="{{ route('admin.categories.index') }}" class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                Categories
            </a>
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                Users
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="menu-item {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                Transactions
            </a>
            <a href="{{ route('admin.reports.index') }}" class="menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Reports
            </a>
            <div class="mt-auto pt-4 border-t border-gray-700 mt-8">
                <a href="{{ route('home') }}" class="menu-item">
                    <i class="fas fa-globe"></i>
                    View Website
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="menu-item w-100 text-left border-0 bg-transparent">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div>
                <h4 class="mb-0 text-amber-500">@yield('title', 'Admin Dashboard')</h4>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-gray-300 dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar mr-2 rounded-circle bg-gray-700 flex items-center justify-center" style="width: 36px; height: 36px;">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="ms-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-gray-700 border-gray-600" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item text-gray-300 hover:bg-gray-600 hover:text-amber-500" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider border-gray-600"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-gray-300 hover:bg-gray-600 hover:text-amber-500">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const contentWrapper = document.querySelector('.content-wrapper');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    contentWrapper.classList.toggle('expanded');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html> 