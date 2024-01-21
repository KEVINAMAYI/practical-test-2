<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\TravelAgent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contract_number' => $this->faker->numberBetween(10000,1000000),
            'status_id' => Status::inRandomOrder()->first()->id,
            'travel_agent_id' => TravelAgent::inRandomOrder()->first()->id,
            'exclusive' => 'yes',
            'start_date' => $this->faker->date,
            'description' => $this->faker->sentence,
            'standard_rate' => '10000/month',
            'added_by' => User::inRandomOrder()->first()->id
        ];
    }
}
