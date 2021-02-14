<?php

namespace Database\Seeders;

use App\Models\Usage;
use Illuminate\Database\Seeder;

class UsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usage::factory(100)->create();
    }
}
