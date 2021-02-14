<?php

namespace Database\Seeders;

use App\Models\PlnCustomer;
use Database\Factories\PlnCustomerFactory;
use Illuminate\Database\Seeder;

class PlnCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlnCustomer::factory(10)->create();
    }
}
