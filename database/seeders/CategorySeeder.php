<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Criar 20 categorias
        $categories = [];
        for ($i = 0; $i < 20; $i++) {
            $categories[] = [
                'name' => fake()->unique()->word(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Category::insert($categories);
        
    }
}
