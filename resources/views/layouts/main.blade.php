<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BookStore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a class="flex items-center text-amber-500 font-bold text-xl" href="{{ route('home') }}">
                    <i class="fas fa-book-open mr-2"></i>BookStore
                </a>
                
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4">
                        <a class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }}" 
                           href="{{ route('home') }}">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                        <a class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('books*') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }}" 
                           href="{{ route('books.index') }}">
                            <i class="fas fa-book mr-1"></i> Books
                        </a>
                        <a class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('categories*') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }}" 
                           href="{{ route('categories.index') }}">
                            <i class="fas fa-tags mr-1"></i> Categories
                        </a>
                        <a class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('about') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }}" 
                           href="{{ route('about') }}">
                            <i class="fas fa-info-circle mr-1"></i> About
                        </a>
                        <a class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('contact') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }}" 
                           href="{{ route('contact') }}">
                            <i class="fas fa-envelope mr-1"></i> Contact
                        </a>
                        
                        @auth
                            <!-- Cart Link -->
                            <a href="{{ route('cart.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cart.index') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }} relative">
                                <i class="fas fa-shopping-cart mr-1"></i> Cart
                                @if(Auth::user()->carts()->count() > 0)
                                    <span class="absolute -top-1 -right-1 bg-amber-500 text-gray-900 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ Auth::user()->carts()->count() }}
                                    </span>
                                @endif
                            </a>

                            <!-- Transactions Link -->
                            <a href="{{ route('transactions.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('transactions.*') ? 'text-amber-500 bg-gray-700' : 'text-gray-300 hover:text-amber-500' }}">
                                <i class="fas fa-receipt mr-1"></i> My Orders
                            </a>

                            <div class="relative ml-3" x-data="{ open: false }">
                                <div>
                                    <button type="button" 
                                            class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-amber-500 items-center text-gray-300 hover:text-amber-500"
                                            @click="open = !open">
                                        <i class="fas fa-user-circle mr-1 text-lg"></i>
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div x-show="open" 
                                     @click.away="open = false" 
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-700 ring-1 ring-black ring-opacity-5">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-amber-500">
                                        <i class="fas fa-user-edit mr-2"></i> Profile
                                    </a>
                                    <div class="border-t border-gray-600"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-amber-500">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-amber-500">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-gray-900 py-2 px-4 rounded-md ml-2 transition-colors">
                                <i class="fas fa-user-plus mr-1"></i> Register
                            </a>
                        @endauth
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button" class="text-gray-300 hover:text-amber-500 focus:outline-none" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div class="hidden md:hidden bg-gray-700 rounded-md mt-2 pb-3 pt-2" id="mobile-menu">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }}">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <a href="{{ route('books.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('books*') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }}">
                    <i class="fas fa-book mr-1"></i> Books
                </a>
                <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('categories*') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }}">
                    <i class="fas fa-tags mr-1"></i> Categories
                </a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('about') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }}">
                    <i class="fas fa-info-circle mr-1"></i> About
                </a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('contact') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }}">
                    <i class="fas fa-envelope mr-1"></i> Contact
                </a>
                
                @auth
                    <!-- Mobile Cart Link -->
                    <a href="{{ route('cart.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cart.index') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }} relative">
                        <i class="fas fa-shopping-cart mr-1"></i> Cart
                        @if(Auth::user()->carts()->count() > 0)
                            <span class="ml-2 bg-amber-500 text-gray-900 text-xs font-bold rounded-full px-2 py-1">
                                {{ Auth::user()->carts()->count() }}
                            </span>
                        @endif
                    </a>

                    <!-- Mobile Transactions Link -->
                    <a href="{{ route('transactions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('transactions.*') ? 'text-amber-500 bg-gray-600' : 'text-gray-300 hover:text-amber-500 hover:bg-gray-600' }}">
                        <i class="fas fa-receipt mr-1"></i> My Orders
                    </a>

                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-amber-500 hover:bg-gray-600">
                        <i class="fas fa-user-edit mr-1"></i> Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block px-3 py-2">
                        @csrf
                        <button type="submit" class="w-full text-left text-base font-medium text-gray-300 hover:text-amber-500">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-amber-500 hover:bg-gray-600">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="block mx-3 mt-1 py-2 px-3 rounded-md text-base font-medium bg-amber-500 text-gray-900 hover:bg-amber-600 text-center">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('header')
        
        @if (session('success'))
            <div class="container mx-auto px-4 py-4">
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        @if (session('error'))
            <div class="container mx-auto px-4 py-4">
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 pt-10 pb-4 mt-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-amber-500">About BookStore</h5>
                    <p class="mb-4">Your one-stop destination for all kinds of books. Discover, learn, and enjoy reading with us.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-amber-500 transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-amber-500 transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-amber-500 transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-amber-500 transition-colors"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-amber-500">Quick Links</h5>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center"><i class="fas fa-angle-right mr-2"></i> Home</a></li>
                        <li><a href="{{ route('books.index') }}" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center"><i class="fas fa-angle-right mr-2"></i> Books</a></li>
                        <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center"><i class="fas fa-angle-right mr-2"></i> Categories</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center"><i class="fas fa-angle-right mr-2"></i> About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-amber-500 transition-colors flex items-center"><i class="fas fa-angle-right mr-2"></i> Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-semibold mb-4 text-amber-500">Contact Info</h5>
                    <ul class="space-y-2">
                        <li class="flex items-start"><i class="fas fa-envelope mt-1 mr-3 text-amber-500"></i> <span>info@bookstore.com</span></li>
                        <li class="flex items-start"><i class="fas fa-phone mt-1 mr-3 text-amber-500"></i> <span>(123) 456-7890</span></li>
                        <li class="flex items-start"><i class="fas fa-map-marker-alt mt-1 mr-3 text-amber-500"></i> <span>123 Book Street, Reading City</span></li>
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 border border-amber-500 text-amber-500 rounded-md hover:bg-amber-500 hover:text-gray-900 transition-colors">
                            Get In Touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-4">
            <div class="container mx-auto px-4">
                <p class="text-center text-gray-500">&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            menuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
    @yield('scripts')

    <!-- Purchase Confirmation Modal -->
    <div id="purchaseModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-bold text-amber-500 mb-4">Confirm Purchase</h3>
            <p class="text-gray-300 mb-4">Are you sure you want to purchase this book?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closePurchaseModal()" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600">
                    Cancel
                </button>
                <form id="purchaseForm" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-amber-500 text-gray-900 rounded-md hover:bg-amber-600">
                        Confirm Purchase
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showPurchaseModal(bookId) {
            const modal = document.getElementById('purchaseModal');
            const form = document.getElementById('purchaseForm');
            form.action = `/transactions/buy/${bookId}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closePurchaseModal() {
            const modal = document.getElementById('purchaseModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>

    @if (session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" 
         x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg"
         x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)">
        {{ session('error') }}
    </div>
    @endif
</body>
</html> 