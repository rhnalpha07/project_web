<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BookStore Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--primary-color);
            padding-top: 20px;
            z-index: 100;
            transition: all 0.3s;
        }
        
        .sidebar-collapsed {
            width: 70px;
        }
        
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        
        .main-content-expanded {
            margin-left: 70px;
        }
        
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--accent-color);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 0;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-text {
            margin-left: 10px;
            transition: opacity 0.3s;
        }
        
        .sidebar-collapsed .nav-text {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 99;
            height: 60px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .content-wrapper {
            min-height: calc(100vh - 60px);
            background-color: #f8f9fa;
        }
        
        .user-profile-dropdown {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="d-flex justify-content-between align-items-center px-3 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                <div class="d-flex align-items-center">
                    <i class="fas fa-book-open fa-2x text-white"></i>
                    <span class="nav-text text-white ms-2 fw-bold h5 mb-0">BookStore Admin</span>
                </div>
            </a>
            <button class="btn btn-sm text-white d-flex d-md-none" id="close-sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt fa-fw"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->routeIs('admin.books*') ? 'active' : '' }}">
                <a href="{{ route('admin.books.index') }}" class="nav-link">
                    <i class="fas fa-book fa-fw"></i>
                    <span class="nav-text">Books</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i class="fas fa-tags fa-fw"></i>
                    <span class="nav-text">Categories</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->routeIs('admin.genres*') ? 'active' : '' }}">
                <a href="{{ route('admin.genres.index') }}" class="nav-link">
                    <i class="fas fa-theater-masks fa-fw"></i>
                    <span class="nav-text">Genres</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users fa-fw"></i>
                    <span class="nav-text">Users</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar fa-fw"></i>
                    <span class="nav-text">Reports</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog fa-fw"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>
        
        <div class="mt-auto mb-4 px-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> <span class="nav-text">Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="top-navbar d-flex justify-content-between align-items-center px-4">
            <button class="btn" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="user-profile-dropdown">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle text-decoration-none text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 text-decoration-none text-dark">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        // Sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const closeSidebar = document.getElementById('close-sidebar');
            
            function toggleSidebar() {
                sidebar.classList.toggle('sidebar-collapsed');
                mainContent.classList.toggle('main-content-expanded');
            }
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            
            if (closeSidebar) {
                closeSidebar.addEventListener('click', function() {
                    if (!sidebar.classList.contains('sidebar-collapsed')) {
                        toggleSidebar();
                    }
                });
            }
            
            // On mobile, collapse sidebar by default
            if (window.innerWidth < 768 && !sidebar.classList.contains('sidebar-collapsed')) {
                toggleSidebar();
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html> 