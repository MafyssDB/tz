<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Продукт №' . random_int(1, 1000),
            'category_id' => random_int(1, 10),
            'price' => random_int(1000, 3000),
            'discount' => random_int(0, 100),
            'own_products' => random_int(0, 1),
            'image' => fake()->imageUrl(),
            'popular' => random_int(0, 200),
        ];
    }
}
