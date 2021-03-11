<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'level' => 'administrator',
                'created_at' => now()
            ],
            [
                'level' => 'pelanggan',
                'created_at' => now()
            ],
            [
                'level' => 'bank',
                'created_at' => now()
            ],
        ]);
    }
}
