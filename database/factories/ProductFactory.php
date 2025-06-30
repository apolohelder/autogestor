<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Definir o estado padrão do modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'user_id' => User::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'is_active' => $this->faker->boolean(90),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Adiciona 1 a 3 categorias aleatórias para cada produto
            $categories = Category::inRandomOrder()
                ->take($this->faker->numberBetween(1, 3))
                ->get();
            
            $product->categories()->attach($categories);
        });
    }
}
