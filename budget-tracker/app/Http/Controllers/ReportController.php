<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthlyReport(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        $incomes = Income::whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as date, SUM(amount) as total')
                         ->groupBy('date')
                         ->get()
                         ->toArray();

        $expenses = Expense::whereYear('date', $year)
                           ->whereMonth('date', $month)
                           ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as date, SUM(amount) as total')
                           ->groupBy('date')
                           ->get()
                           ->toArray();

        $totalIncome = array_sum(array_column($incomes, 'total'));
        $totalExpense = array_sum(array_column($expenses, 'total'));
        $balance = $totalIncome - $totalExpense;

        return view('reports.monthly', [
            'incomes' => $incomes,
            'expenses' => $expenses,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'year' => $year,
            'month' => $month
        ]);
    }

}