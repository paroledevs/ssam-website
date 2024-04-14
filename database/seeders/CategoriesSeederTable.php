<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class CategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title' => 'Entradas'],
            ['title' => 'Especialidades'],
            ['title' => 'Ramyeon'],
            ['title' => 'Parrillada, Postres y Bebidas'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $categories = [
            ['title' => 'Entradas'],
            ['title' => 'Platos Fuertes'],
            ['title' => 'Postres'],
            ['title' => 'Bebidas'],
        ];

        foreach ($categories as $category) {
            PostCategory::create($category);
        }

        $this->command->warn('Categories created!');
    }
}
