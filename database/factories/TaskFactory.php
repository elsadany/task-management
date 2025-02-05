<?php

namespace Database\Factories;

use App\Enums\UsersRoleEnum;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'due_date' => fake()->dateTimeBetween('+1 week', '+1 month'),
            'assignee_id' => User::where('role', UsersRoleEnum::USER)->inRandomOrder()->first()->id,
        ];
    }
}
