<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(PlnCustomerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UsageSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionLevelSeeder::class);
    }
}
