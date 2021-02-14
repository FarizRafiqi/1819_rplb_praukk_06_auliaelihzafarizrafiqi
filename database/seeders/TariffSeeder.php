<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tariffs')->insert(
            ['golongan_tarif' => 'R1M', 'daya' => 900, 'tarif_per_kwh' => 1470.00]
        );
    }
}
