@extends('layouts.main')

@section('title', 'Transaction Details')

@section('content')
<div class="bg-gray-900 text-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-amber-500 mb-2">Transaction Details</h1>
                <p class="text-gray-400">Your purchase information</p>
            </div>

            <!-- Transaction Card -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Status Badge -->
                <div class="bg-amber-500 text-gray-900 px-4 py-2">
                    <span class="font-medium">Status: {{ ucfirst($transaction->status) }}</span>
                </div>

                <!-- Transaction Details -->
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Book Information -->
                        <div class="border-b border-gray-700 pb-4">
                            <h2 class="text-xl font-bold text-amber-500 mb-2">Book Information</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-400">Title</p>
                                    <p class="text-gray-200">{{ $transaction->book->title }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Author</p>
                                    <p class="text-gray-200">{{ $transaction->book->author }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Information -->
                        <div class="border-b border-gray-700 pb-4">
                            <h2 class="text-xl font-bold text-amber-500 mb-2">Transaction Information</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-400">Transaction ID</p>
                                    <p class="text-gray-200">#{{ $transaction->id }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Date</p>
                                    <p class="text-gray-200">{{ $transaction->transaction_date->format('M d, Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Amount</p>
                                    <p class="text-gray-200">${{ number_format($transaction->amount, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Payment Method</p>
                                    <p class="text-gray-200">{{ ucfirst($transaction->payment_method) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <h2 class="text-xl font-bold text-amber-500 mb-2">Description</h2>
                            <p class="text-gray-200">{{ $transaction->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-gray-700 px-6 py-4 flex justify-between items-center">
                    <a href="{{ route('books.index') }}" class="text-gray-300 hover:text-amber-500 transition-colors">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Books
                        </span>
                    </a>
                    <a href="{{ route('transactions.index') }}" class="bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold py-2 px-4 rounded-md transition-colors">
                        View All Transactions
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 