<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'brand_id' => 1,
            'name' => 'Mi primer vehiculo',
            'number_plate' => 'MX-12321',
        ]);

        // DB::table('vehicles')->insert([
        //     'brand_id' => 2,
        //     'name' => 'Mi segundo vehiculo',
        //     'number_plate' => 'VX-12321',
        // ]);

        // DB::table('vehicles')->insert([
        //     'brand_id' => 3,
        //     'name' => 'Mi TERCER vehiculo',
        //     'number_plate' => 'AO-745745',
        // ]);

        // DB::table('vehicles')->insert([
        //     'brand_id' => 1,
        //     'name' => 'Mi cuarto vehiculo',
        //     'number_plate' => 'OP-745745',
        // ]);
        
    }
}
