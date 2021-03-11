<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Tarif dasar listrik pascabayar ini mengikuti aturan 
 * Tariff Adjusment PLN periode oktober-desember 2020
 */
class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tariffs')->insert([
            ['golongan_tarif' => 'R1M', 'daya' => 900, 'tarif_per_kwh' => 1352.00],
            ['golongan_tarif' => 'R1', 'daya' => 1300, 'tarif_per_kwh' => 1444.70],
            ['golongan_tarif' => 'R1', 'daya' => 2200, 'tarif_per_kwh' => 1444.70],
            ['golongan_tarif' => 'R2', 'daya' => 3500, 'tarif_per_kwh' => 1444.70],
            ['golongan_tarif' => 'R2', 'daya' => 5500, 'tarif_per_kwh' => 1444.70],
            ['golongan_tarif' => 'R3', 'daya' => 6600, 'tarif_per_kwh' => 1444.70],
            ['golongan_tarif' => 'B2', 'daya' => 6600, 'tarif_per_kwh' => 1444.70],
            ['golongan_tarif' => 'B2', 'daya' => 200000, 'tarif_per_kwh' => 1444.70],
        ]);
    }
}
