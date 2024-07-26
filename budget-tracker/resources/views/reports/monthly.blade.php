@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Monthly Report</h1>

    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('monthly.report') }}" class="mb-4">
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" class="form-control" value="{{ $year }}" required>
        </div>
        <div class="form-group">
            <label for="month">Month:</label>
            <select id="month" name="month" class="form-control" required>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Generate Report</button>
    </form>

    <!-- Monthly Report Tables -->
    <div class="mb-4">
        <h3>Income</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($incomes as $income)
                <tr>
                    <td>{{ $income['date'] }}</td>
                    <td> ₹{{ number_format($income['total'], 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center">No income records for this period.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <h3>Expenses</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense['date'] }}</td>
                    <td>₹{{ number_format($expense['total'], 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center">No expense records for this period.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        <h3>Summary</h3>
        <p><strong>Total Income:</strong> ₹{{ number_format($totalIncome, 2) }}</p>
        <p><strong>Total Expenses:</strong> ₹{{ number_format($totalExpense, 2) }}</p>
        <p><strong>Balance:</strong> ₹{{ number_format($balance, 2) }}</p>
    </div>
</div>
@endsection
