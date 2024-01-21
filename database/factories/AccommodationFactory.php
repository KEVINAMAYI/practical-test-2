<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetAddress,
            'description' => $this->faker->sentence,
            'country' =>  $this->faker->country,
            'city' =>  $this->faker->city,
            'address' =>  $this->faker->address,
            'status_id' => Status::inRandomOrder()->first()->id,
            'standard_rack_rate' => '1000/day',
        ];
    }
}
