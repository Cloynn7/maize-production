<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\discount_code>
 */
class DiscountCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(Str::random(4)), // Misal, kode acak 8 karakter
            'min_price' => $this->faker->randomNumber(3), // Harga minimal acak
            'type' => 'percentage', // Jenis diskon acak
            'offer' => $this->faker->numberBetween(20, 50), // Besar diskon acak antara 1 dan 50
            'max_offer' => $this->faker->optional()->randomNumber(3), // Maksimal diskon acak antara 51 dan 100 (opsional)
            'expire_date' => $this->faker->dateTimeBetween('now', '+1 year'), // Tanggal kedaluwarsa acak dalam satu tahun dari sekarang
        ];
    }
}
