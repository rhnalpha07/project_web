<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-8">
        <div class="w-full max-w-5xl flex bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
            <!-- Left Side - Banner -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-amber-500 to-amber-600 p-12 flex-col justify-between relative">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Welcome to BookStore</h2>
                    <p class="text-lg text-gray-800">Discover a world of knowledge and adventure through our vast collection of books.</p>
                </div>
                <div class="absolute bottom-8 right-8 text-gray-900 opacity-10">
                    <i class="fas fa-books text-9xl"></i>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 p-8 sm:p-12">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-amber-500 mb-2">Sign In</h1>
                    <p class="text-gray-400">Welcome back! Please enter your details</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-900/50 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-gray-100 focus:border-amber-500 focus:ring-2 focus:ring-amber-500 focus:ring-opacity-50 transition-colors">
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-gray-100 focus:border-amber-500 focus:ring-2 focus:ring-amber-500 focus:ring-opacity-50 transition-colors">
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-amber-500 focus:ring-amber-500 focus:ring-offset-gray-800">
                            <label for="remember" class="ml-2 text-sm text-gray-300">Remember me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-amber-500 hover:text-amber-400 transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-gray-900 font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign in
                    </button>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-800 text-gray-400">or continue with</span>
                        </div>
                    </div>

                    <button type="button" class="w-full border border-gray-600 text-gray-300 hover:border-amber-500 hover:text-amber-500 font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <i class="fab fa-google"></i>
                        Sign in with Google
                    </button>

                    <div class="text-center mt-8">
                        <p class="text-gray-400">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-amber-500 hover:text-amber-400 font-medium transition-colors">
                                Sign up for free
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Add any custom JavaScript here
    </script>
</body>
</html>
