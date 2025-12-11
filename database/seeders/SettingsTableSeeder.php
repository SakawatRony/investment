<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('settings')->delete();

         \DB::table('settings')->insert([
            0 => [
                'id' => 1,
                'company_name' => 'Royal Glory Residence Ltd',
                'address' => 'Plot – 4 & 6, Road 7, Sector 15, Uttara, Dhaka',
                'phone' => "+880 1713482184",
                'logo' => null,
                'total_interest' => null,
                'params' => null,
            ]
        ]);
    }
}
