@extends('layouts.main')

@section('title', 'My Profile')

@section('content')
<div class="bg-gray-900 text-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-bold text-amber-500 mb-8">My Profile</h1>
            
            @if (session('status') === 'profile-updated')
                <div class="mb-6 bg-green-800 border border-green-700 text-green-100 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">Profile information updated successfully.</span>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="mb-6 bg-green-800 border border-green-700 text-green-100 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">Password updated successfully.</span>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sidebar -->
                <div class="md:col-span-1">
                    <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col items-center text-center mb-6">
                                <div class="h-24 w-24 rounded-full bg-amber-500 flex items-center justify-center text-gray-900 font-bold text-3xl mb-4">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <h2 class="text-xl font-bold text-gray-200">{{ $user->name }}</h2>
                                <p class="text-gray-400">{{ $user->email }}</p>
                                <p class="text-xs text-gray-500 mt-1">Member since {{ $user->created_at->format('M Y') }}</p>
                            </div>
                            
                            <div class="border-t border-gray-700 py-4">
                                <nav class="space-y-2">
                                    <a href="#profile-info" class="block px-4 py-2 rounded-lg bg-gray-700 text-amber-500 font-medium">
                                        Personal Information
                                    </a>
                                    <a href="#password" class="block px-4 py-2 rounded-lg hover:bg-gray-700 text-gray-300 font-medium transition-colors duration-200">
                                        Password
                                    </a>
                                    <a href="#delete-account" class="block px-4 py-2 rounded-lg hover:bg-gray-700 text-gray-300 font-medium transition-colors duration-200">
                                        Delete Account
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order History Card -->
                    <div class="mt-6 bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-200 mb-4">Order History</h3>
                            <a href="{{ route('transactions.index') }}" class="inline-flex items-center text-amber-500 hover:text-amber-400">
                                <span>View all orders</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="md:col-span-2 space-y-8">
                    <!-- Profile Information -->
                    <div id="profile-info" class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-200">Personal Information</h3>
                            <p class="text-gray-400 text-sm">Update your account's profile information and email address.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    
                    <!-- Update Password -->
                    <div id="password" class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-200">Update Password</h3>
                            <p class="text-gray-400 text-sm">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                    
                    <!-- Delete Account -->
                    <div id="delete-account" class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                            <h3 class="text-xl font-semibold text-red-400">Delete Account</h3>
                            <p class="text-gray-400 text-sm">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
