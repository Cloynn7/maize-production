<?php

namespace Database\Factories;

use App\Models\Seat;
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

    protected $model = Seat::class;

    public function definition(): array
    {
        return [
            // 'seat' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E']) . $this->faker->randomDigit,
            'status' => 'available',
            // 'class' => $this->faker->randomElement(['regular', 'vip']),
            // 'price' => $this->faker->numberBetween(1000, 10000),
        ];
    }

    public function maker($seatPrefix, $count, $class, $price)
    {
        $seats = [];

        for ($i = 1; $i <= $count; $i++) {
            $seats[] = [
                'seat' => $seatPrefix . $i,
                'class' => $class,
                'price' => $price,
            ];
        }

        return $this->state([])->createMany($seats);
    }
}
