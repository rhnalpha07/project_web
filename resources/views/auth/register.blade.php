<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BookStore</title>
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
    <style>
        .auth-card {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo and Header -->
        <div class="text-center">
            <h2 class="mt-6 text-4xl font-bold text-amber-500 font-sans">BookStore</h2>
            <h3 class="mt-2 text-xl text-gray-300">Create your account</h3>
        </div>
        
        <!-- Register Card -->
        <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden p-8 space-y-6 auth-card">
            @if ($errors->any())
                <div class="mb-4 bg-red-900/50 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                        <input id="name" name="name" type="text" autocomplete="name" required 
                            class="w-full bg-gray-700 border border-gray-600 rounded-md py-3 px-4 pl-10 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                            placeholder="Enter your full name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="w-full bg-gray-700 border border-gray-600 rounded-md py-3 px-4 pl-10 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                            placeholder="Enter your email address" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-500"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                            class="w-full bg-gray-700 border border-gray-600 rounded-md py-3 px-4 pl-10 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('password') border-red-500 @enderror" 
                            placeholder="Create a password">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-check-circle text-gray-500"></i>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                            class="w-full bg-gray-700 border border-gray-600 rounded-md py-3 px-4 pl-10 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" 
                            placeholder="Confirm your password">
                    </div>
                </div>
                
                <!-- Terms & Conditions (Optional) -->
                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" 
                        class="h-4 w-4 text-amber-500 focus:ring-amber-500 border-gray-600 rounded bg-gray-700">
                    <label for="terms" class="ml-2 block text-sm text-gray-300">
                        I agree to the <a href="#" class="text-amber-500 hover:text-amber-400">Terms and Conditions</a>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-gray-900 font-medium bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Account
                    </button>
                </div>
            </form>
            
            <!-- Login Link -->
            <div class="text-center">
                <p class="text-sm text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-amber-500 hover:text-amber-400 font-medium ml-1">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Back to Home -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-amber-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
    
    <!-- Background Decoration (Optional) -->
    <div class="hidden md:block absolute top-0 right-0 w-full h-full overflow-hidden z-[-1]">
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-900 rounded-full opacity-10 transform translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-900 rounded-full opacity-10 transform -translate-x-1/2 translate-y-1/2"></div>
    </div>
</body>
</html>
