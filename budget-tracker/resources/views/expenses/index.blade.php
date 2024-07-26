@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Expenses</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-custom mb-3">Add Expense</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
            <tr>
                <td>{{ $expense->description }}</td>
                <td>₹{{ number_format($expense->amount, 2) }}</td>
                <td>{{ $expense->date->format('Y-m-d') }}</td> <!-- This should work now -->
                <td>
                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No expenses found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection