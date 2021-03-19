<?php

namespace Database\Seeders;

use App\Models\TaxType;
use Illuminate\Database\Seeder;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaxType::create([
            'name' => 'Pajak Penerangan Jalan',
            'description' => 'Pajak Penerangan Jalan (PPJ) adalah pajak yang wajib dibayar oleh pelanggan listrik PLN. Dimana hasil PPJ tersebut merupakan salah satu Pendapatan Asli Daerah (PAD) yang digunakan untuk membiayai daerah, termasuk pemasangan dan pemeliharaan serta pembayaran rekening Penerangan Jalan Umum (PJU) sesuai kemampuan PEMDA.'
        ]);
    }
}
