<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('user_roles')->delete();

         \DB::table('user_roles')->insert([
            0 => [
                'user_id' => 1,
                'role_id' => 1,
            ],
            1 => [
                'user_id' => 2,
                'role_id' => 2,
            ]
        ]);
    }
}
