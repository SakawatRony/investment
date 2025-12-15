<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \DB::table('roles')->delete();

         \DB::table('roles')->insert([
            0 => [
                'id' => 1,
                'name' => 'Super Admin',
            ],
            1 => [
                'id' => 2,
                'name' => 'Admin',
            ],
            2 => [
                'id' => 3,
                'name' => 'User',
            ],
            3 => [
                'id' => 4,
                'name' => 'Manager',
            ],
            4 => [
                'id' => 5,
                'name' => 'Accounts ',
            ],
            5 => [
                'id' => 6,
                'name' => 'IT ',
            ],
            6 => [
                'id' => 7,
                'name' => 'Executive  ',
            ],
        ]);
    }
}
