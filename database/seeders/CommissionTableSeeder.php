<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('commissions')->delete();

         \DB::table('commissions')->insert([
            0 => [
                'id' => 1,
                'name' => 'First Child',
                'slug' => 'first',
                'value' => 5
            ],
            1 => [
                'id' => 2,
                'name' => 'Second Child',
                'slug' => 'second',
                'value' => 2.5
            ],
            2 => [
                'id' => 3,
                'name' => 'Third Child',
                'slug' => 'third',
                'value' => 1.5
            ]
        ]);
    }
}
