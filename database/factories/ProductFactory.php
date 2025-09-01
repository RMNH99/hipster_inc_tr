<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name'  => $this->faker->word(),
            'price' => $this->faker->numberBetween(10, 500),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}

