<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalIncome = $user->incomes()->sum('amount');
        $totalExpenses = $user->expenses()->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $incomes = $user->incomes()
                        ->whereYear('date', $year)
                        ->whereMonth('date', $month)
                        ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as date, SUM(amount) as total')
                        ->groupBy('date')
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [(string) $item->date => (float) $item->total];
                        });

        $expenses = $user->expenses()
                         ->whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as date, SUM(amount) as total')
                         ->groupBy('date')
                         ->get()
                         ->mapWithKeys(function ($item) {
                             return [(string) $item->date => (float) $item->total];
                         });

        return view('dashboard.index', compact('totalIncome', 'totalExpenses', 'balance', 'incomes', 'expenses'));
    }
}