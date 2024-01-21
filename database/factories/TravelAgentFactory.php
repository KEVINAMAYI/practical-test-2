<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelAgent>
 */
class TravelAgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'experience' => $this->faker->sentence,
            'about_me' => $this->faker->sentence,
            'status_id' => Status::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
