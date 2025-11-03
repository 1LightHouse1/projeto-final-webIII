<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Eletrônicos',
            'description' => 'Produtos eletrônicos diversos'
        ]);

        Category::create([
            'name' => 'Roupas',
            'description' => 'Roupas e acessórios'
        ]);

        Category::create([
            'name' => 'Livros',
            'description' => 'Livros físicos e digitais'
        ]);

        Category::create([
            'name' => 'Casa e Jardim',
            'description' => 'Produtos para casa e jardim'
        ]);
    }
}
