<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'nama' => 'VA BCA', 
                'gambar' => 'img/payment-method/bca-thumb.png',
                'slug' => 'va-bca', 
                'deskripsi' => '-',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'nama' => 'VA Mandiri', 
                'gambar' => 'img/payment-method/mandiri-thumb.png',
                'slug' => 'va-mandiri', 
                'deskripsi' => '-',
                'created_at' => now(),
                'updated_at' => null,
            ],
            [
                'nama' => 'VA BNI', 
                'gambar' => 'img/payment-method/bni-thumb.png',
                'slug' => 'va-bni', 
                'deskripsi' => '-',
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);
    }
}
