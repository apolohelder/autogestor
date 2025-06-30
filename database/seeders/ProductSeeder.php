<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Executar as seeds do banco de dados.
     */
    public function run(): void
    {
        
        // Verifica se há marcas (executa o BrandSeeder se não houver)
        if (Brand::count() === 0) {
            $this->call(BrandSeeder::class);
        }

        // Certifique-se que existem categorias
        if (Category::count() === 0) {
            Category::factory()->count(20)->create();
        }

        /// Criar 100 produtos
        Product::factory(100)->create()->each(function ($product) {

            // Atribuir 1 a 3 categorias aleatórias para cada produto
            $categories = Category::inRandomOrder()->take(rand(1, 3))->get();
            
            $product->categories()->attach($categories);

            // Atribuir uma marca aleatória se não houver
            if (!$product->brand_id) {
                $product->update([
                    'brand_id' => Brand::inRandomOrder()->first()->id
                ]);
            }
            
        });
    }
}
