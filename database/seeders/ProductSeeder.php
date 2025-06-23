<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Test Product A', 'sku' => 'TP001', 'price' => 100, 'quantity' => 50],
            ['name' => 'Test Product B', 'sku' => 'TP002', 'price' => 150, 'quantity' => 30],
            ['name' => 'Test Product C', 'sku' => 'TP003', 'price' => 200, 'quantity' => 70],
            ['name' => 'Test Product D', 'sku' => 'TP004', 'price' => 350, 'quantity' => 80],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],$product
            );
        }
    }
}
