<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'apple', 'price' => 10.50, 'quantity' => 100],
            ['name' => 'orange', 'price' => 20.00, 'quantity' => 200],
            ['name' => 'mango', 'price' => 30.25, 'quantity' => 150],
            ['name' => 'durian', 'price' => 40.75, 'quantity' => 50],
            ['name' => 'grape', 'price' => 50.00, 'quantity' => 300],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
