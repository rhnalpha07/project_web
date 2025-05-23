<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['book', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('transactions.index');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['book', 'user']);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $transaction->update([
            'amount' => $request->amount,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('transactions.index');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }

    public function buy($bookId)
    {
        $book = Book::findOrFail($bookId);
        
        // Create a dummy transaction
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'amount' => $book->price,
            'status' => 'completed', // For dummy transactions, we'll set it as completed
            'payment_method' => 'dummy_payment',
            'transaction_date' => now(),
            'description' => "Purchase of {$book->title}"
        ]);

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Purchase completed successfully!');
    }
}
