<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop Asus',
                'description' => 'Laptop',
                'price' => '4000000',
                'stock' => 4,
                'category_product_id' => 1,
                'images' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Laptop Maccbook',
                'description' => 'Laptop',
                'price' => '4000000',
                'stock' => 4,
                'category_product_id' => 1,
                'images' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
