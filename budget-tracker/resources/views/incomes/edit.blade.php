@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Income</h1>
    <form action="{{ route('incomes.update', $income->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $income->description) }}" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $income->amount) }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $income->date->format('Y-m-d')) }}" required>
        </div>
        <button type="submit" class="btn btn-custom mt-3">Update Income</button>
    </form>
</div>
@endsection