<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Income;

class IncomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_income()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/incomes', [
            'description' => 'Salary',
            'amount' => 1000,
            'date' => '2024-07-01',
        ]);

        $response->assertRedirect('/incomes');
        $this->assertDatabaseHas('incomes', [
            'description' => 'Salary',
            'amount' => 1000,
            'date' => '2024-07-01',
        ]);
    }
}
