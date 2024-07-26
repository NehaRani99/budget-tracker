<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        Expense::create([
            'user_id' => 1,
            'description' => 'Groceries',
            'amount' => 50.00,
            'date' => now()->subDays(10),
        ]);

        Expense::create([
            'user_id' => 1,
            'description' => 'Electricity Bill',
            'amount' => 100.00,
            'date' => now()->subDays(5),
        ]);
    }
}