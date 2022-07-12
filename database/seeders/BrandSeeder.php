<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'BMW',
        ]);

        DB::table('brands')->insert([
            'name' => 'Toyota',
        ]);

        DB::table('brands')->insert([
            'name' => 'Nissan',
        ]);
        
        DB::table('brands')->insert([
            'name' => 'Renault',
        ]);
        DB::table('brands')->insert([
            'name' => 'Ford',
        ]);
        
    }
}
