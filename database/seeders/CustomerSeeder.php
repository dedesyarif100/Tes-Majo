<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'Taylor Otwell',
                'address' => 'America'
            ],
            [
                'name' => 'James Bonn',
                'address' => 'America'
            ]
        ]);
    }
}
