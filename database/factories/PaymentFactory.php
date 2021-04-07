<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['success', 'failed', 'pending', 'expire'];
        return [
            'id_customer' => rand(1,10),
            'id_pelanggan_pln' => rand(1,10),
            'tanggal_bayar' => $this->faker->dateTimeThisMonth,
            'biaya_admin' => config('const.biaya_admin'),
            'total_bayar' => rand(10000, 10000000),
            'id_metode_pembayaran' => 1,
            'status' => $status[rand(0,3)]
        ];
    }
}
