<?php

namespace Database\Factories;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $status = ['BELUM LUNAS', 'LUNAS'];
        return [
            'id_penggunaan' => rand(1,100),
            'bulan' => $bulan[rand(0,11)],
            'tahun' => $this->faker->year(),
            'jumlah_kwh' => rand(1,500),
            'status' => $status[rand(0,1)]
        ];
    }
}
