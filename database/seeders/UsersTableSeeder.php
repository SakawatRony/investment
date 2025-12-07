<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->delete();

         \DB::table('users')->insert([
            0 => [
                'id' => 1,
                'full_name' => 'Super Admin',
                'user_name' => 'super_admin123',
                'phone' => '01758376773',
                'nid' => 123,
                'email' => null,
                'password' => '$2y$10$AkkNfWst7s8ZzCg2imU9X.hM0sVSOA/2KHMSiMUy473QUJKARjq9G',
                'status' => 'active',
                'is_verified' => 1,
            ],
            1 => [
                'id' => 2,
                'full_name' => 'Royal Glory Residence Ltd',
                'user_name' => 'admin',
                'phone' => 123,
                'nid' => 123,
                'email' => null,
                'password' => '$2y$12$zubMii3kX8y2EUKqA.tnN.DbCS.ZR0pohK.lv7f7gqg0UUAsb2hmy',
                'status' => 'active',
                'is_verified' => 1,
            ]
        ]);
    }
}
