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
        $status = ['success', 'failed', 'pending'];
        return [
            'id_customer' => rand(1,10),
            'id_pelanggan_pln' => rand(1,10),
            'id_tagihan' => rand(1,100),
            'tanggal_bayar' => $this->faker->dateTimeThisMonth,
            'denda' => 0,
            'biaya_admin' => 2500,
            'total_bayar' => rand(10000, 10000000),
            'status' => $status[rand(0,2)]
        ];
    }
}
