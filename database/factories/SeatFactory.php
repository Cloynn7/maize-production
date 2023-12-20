<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seat' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E']) . $this->faker->randomDigit,
            'status' => 'available',
            'class' => $this->faker->randomElement(['regular', 'vip']),
            'price' => $this->faker->numberBetween(1000, 10000),
        ];
    }
}
