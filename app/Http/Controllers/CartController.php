<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('book')
            ->where('user_id', Auth::id())
            ->get();
        
        $total = $cartItems->sum('subtotal');
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        
        // Check if book already in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->first();
        
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => 1,
                'price' => $book->price
            ]);
        }
        
        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function update(Request $request, $cartId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $cartId)
            ->firstOrFail();
        
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
        
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($cartId)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $cartId)
            ->firstOrFail();
        
        $cartItem->delete();
        
        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function checkout()
    {
        $cartItems = Cart::with('book')
            ->where('user_id', Auth::id())
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }
        
        // Create transactions for each cart item
        foreach ($cartItems as $item) {
            Transaction::create([
                'user_id' => Auth::id(),
                'book_id' => $item->book_id,
                'amount' => $item->subtotal,
                'status' => 'completed',
                'payment_method' => 'dummy_payment',
                'transaction_date' => now(),
                'description' => "Purchase of {$item->book->title}"
            ]);
        }
        
        // Clear the cart
        Cart::where('user_id', Auth::id())->delete();
        
        return redirect()->route('transactions.index')
            ->with('success', 'Checkout completed successfully!');
    }
}
