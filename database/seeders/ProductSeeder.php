<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $eletronicos = Category::where('name', 'Eletrônicos')->first();
        $roupas = Category::where('name', 'Roupas')->first();
        $livros = Category::where('name', 'Livros')->first();
        $casa = Category::where('name', 'Casa e Jardim')->first();

        Product::create([
            'name' => 'Smartphone XYZ',
            'description' => 'Smartphone com 128GB de armazenamento',
            'price' => 1299.90,
            'stock' => 50,
            'category_id' => $eletronicos->id
        ]);

        Product::create([
            'name' => 'Notebook Gamer',
            'description' => 'Notebook para jogos com 16GB RAM',
            'price' => 3500.00,
            'stock' => 25,
            'category_id' => $eletronicos->id
        ]);

        Product::create([
            'name' => 'Camiseta Básica',
            'description' => 'Camiseta de algodão 100%',
            'price' => 39.90,
            'stock' => 100,
            'category_id' => $roupas->id
        ]);

        Product::create([
            'name' => 'Calça Jeans',
            'description' => 'Calça jeans masculina',
            'price' => 89.90,
            'stock' => 80,
            'category_id' => $roupas->id
        ]);

        Product::create([
            'name' => 'Livro PHP Avançado',
            'description' => 'Guia completo de PHP',
            'price' => 89.50,
            'stock' => 30,
            'category_id' => $livros->id
        ]);

        Product::create([
            'name' => 'Laravel Framework',
            'description' => 'Aprenda Laravel do zero',
            'price' => 120.00,
            'stock' => 20,
            'category_id' => $livros->id
        ]);

        Product::create([
            'name' => 'Mesa de Jantar',
            'description' => 'Mesa de madeira para 6 pessoas',
            'price' => 899.90,
            'stock' => 15,
            'category_id' => $casa->id
        ]);

        Product::create([
            'name' => 'Cadeira Ergonômica',
            'description' => 'Cadeira de escritório ergonômica',
            'price' => 450.00,
            'stock' => 40,
            'category_id' => $casa->id
        ]);
    }
}
