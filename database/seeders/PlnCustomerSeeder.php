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
        // PlnCustomer::factory(10)->create();
        PlnCustomer::create([
            'nama_pelanggan' => 'Aulia El Ihza Fariz Rafiqi',
            'nomor_meter' => '537320018623',
            'alamat' => 'ujung harapan, JL Al-Ikhlas 14, RT 007, RW 015, Kelurahan Bahagia, Kecamatan Babelan, Bekasi Utara, Jawa Barat, Indonesia',
            'id_kota' => '3275',
            'id_tarif' => 1,
        ]);
    }
}
