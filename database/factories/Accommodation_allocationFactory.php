<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\Contract;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation_allocation>
 */
class Accommodation_allocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contract_id' => Contract::inRandomOrder()->first()->id,
            'accommodation_id'  => Accommodation::inRandomOrder()->first()->id,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'status_id' => Status::inRandomOrder()->first()->id,
        ];
    }
}
