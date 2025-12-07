<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Dompet', 'description' => 'Dompet dan kartu identitas'],
            ['category_name' => 'Elektronik', 'description' => 'HP, laptop, tablet, dll'],
            ['category_name' => 'Alat Tulis', 'description' => 'Pena, buku, kalkulator'],
            ['category_name' => 'Pakaian', 'description' => 'Jaket, tas, sepatu'],
            ['category_name' => 'Kunci', 'description' => 'Kunci motor, mobil, rumah'],
            ['category_name' => 'Lainnya', 'description' => 'Barang lain'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}