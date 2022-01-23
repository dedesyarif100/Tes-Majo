<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Toko Jaya',
                'category_product_id' => 1,
            ],
            [
                'name' => 'Toko Asa',
                'category_product_id' => 2,
            ]
        ]);
    }
}
