<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('transactions')
            ->withSum('transactions', 'amount')
            ->latest()
            ->paginate(15);

        $statistics = [
            'total_users' => User::count(),
            'active_users' => User::has('transactions')->count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)->count(),
            'total_revenue' => Transaction::sum('amount')
        ];

        return view('admin.users.index', compact('users', 'statistics'));
    }

    public function show(User $user)
    {
        $user->load(['transactions.book']);
        
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->transactions()->exists()) {
            return back()->with('error', 'Cannot delete user with transactions');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
} 