<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'GIN' => Str::random(5),
            'lot_no' => '',
            'description' => $this->faker->text(10),
            'UOM' => Str::random(3),
            'category' => $this->faker->randomElement(['FM','Non-FM']),
            'country_code' => 'AE',
            'status' => 1
        ];
    }
}
