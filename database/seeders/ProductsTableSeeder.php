<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => 19.99,
                'size' => 'Small',
                'type' => 'Type A',
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => 29.99,
                'size' => 'Medium',
                'type' => 'Type B',
            ],
        ];

        // foreach ($products as $productData) {
        //     Product::create($productData);
        // }

        Product::factory(30)->create();

    }
}
