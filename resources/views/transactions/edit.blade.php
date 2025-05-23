@extends('layouts.app')
@section('content')
    <h1>Edit Transaction</h1>
    <form action="{{ route('transactions.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="amount">Amount:</label>
        <input type="number" name="amount" step="0.01" value="{{ $transaction->amount }}" required>
        <label for="status">Status:</label>
        <input type="text" name="status" value="{{ $transaction->status }}" required>
        <label for="description">Description:</label>
        <textarea name="description">{{ $transaction->description }}</textarea>
        <button type="submit">Update Transaction</button>
    </form>
    <a href="{{ route('transactions.index') }}">Back to List</a>
@endsection 