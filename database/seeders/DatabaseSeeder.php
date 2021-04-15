<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TariffSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(PlnCustomerSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(UsageSeeder::class);
        // $this->call(BillSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        // $this->call(PaymentSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionLevelSeeder::class);
        $this->call(TaxTypeSeeder::class);
        $this->call(TaxRateSeeder::class);
    }
}
