@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>
                    <p class="card-text">₹{{ number_format($totalIncome, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Expenses</h5>
                    <p class="card-text">₹{{ number_format($totalExpenses, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Balance</h5>
                    <p class="card-text">₹{{ number_format($balance, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- highcharts -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h3 class="mb-4">Income and Expense Chart</h3>
            <div id="chart-container" style="width:100%; height:400px;"></div>
        </div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const incomes = @json($incomes);
    const expenses = @json($expenses);

    Highcharts.chart('chart-container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Income and Expense Data'
        },
        xAxis: {
            categories: Array.from(new Set([...Object.keys(incomes), ...Object.keys(expenses)])).sort() // Combine and sort dates
        },
        yAxis: {
            title: {
                text: 'Amount'
            }
        },
        series: [{
            name: 'Income',
            data: Array.from(new Set([...Object.keys(incomes), ...Object.keys(expenses)])).sort().map(date => incomes[date] || 0)
        }, {
            name: 'Expense',
            data: Array.from(new Set([...Object.keys(incomes), ...Object.keys(expenses)])).sort().map(date => expenses[date] || 0)
        }]
    });
});
</script>
@endsection