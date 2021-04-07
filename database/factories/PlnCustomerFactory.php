<?php

namespace Database\Factories;

use App\Models\PlnCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlnCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlnCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pelanggan' => $this->faker->name,
            'nomor_meter' => rand(000000000000, 999999999999),
            'alamat' => $this->faker->address,
        ];
    }
}
