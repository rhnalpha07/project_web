@extends('layouts.app')
@section('content')
    <h1>Create Transaction</h1>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" name="amount" step="0.01" required>
        <label for="status">Status:</label>
        <input type="text" name="status" required>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>
        <button type="submit">Save Transaction</button>
    </form>
@endsection 