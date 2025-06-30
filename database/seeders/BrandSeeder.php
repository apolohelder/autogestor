<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria uma marca padrão "Sem Marca"
        Brand::create(['name' => 'Sem Marca']);

        // Cria 10 marcas aleatórias
        Brand::factory(10)->create();
    }
}
