@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Incomes</h1>
    <a href="{{ route('incomes.create') }}" class="btn btn-custom mb-3">Add Income</a>
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
            @forelse ($incomes as $income)
            <tr>
                <td>{{ $income->description }}</td>
                <td>₹{{ number_format($income->amount, 2) }}</td>
                <td>{{ $income->date->format('Y-m-d') }}</td> <!-- Should work if $income->date is a Carbon instance -->
                <td>
                    <a href="{{ route('incomes.edit', $income) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('incomes.destroy', $income) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No incomes found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
