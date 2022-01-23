<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_products')->insert([
            [
                'name' => 'Komputer',
                'code' => 'KP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kendaraan',
                'code' => 'KD',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
