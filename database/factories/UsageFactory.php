<?php

namespace Database\Factories;

use App\Models\Usage;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return [
            'id_pelanggan_pln' => rand(1,10),
            'bulan' => $bulan[rand(0,11)],
            'tahun' => date('Y'),
            'meter_awal' => rand(00000000, 10000000),
            'meter_akhir' => rand(00000000, 10000000),
        ];
    }
}
