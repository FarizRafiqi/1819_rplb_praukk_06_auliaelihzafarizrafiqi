<?php 

return [
    /*
    |--------------------------------------------------------------------------
    | Biaya Admin
    |--------------------------------------------------------------------------
    |
    | Adalah biaya yang dikenakan pada setiap pembayaran
    */

    'biaya_admin' => 2500,

    /*
    |--------------------------------------------------------------------------
    | Pajak Penerangan Jalan (PPJ)
    |--------------------------------------------------------------------------
    |
    | Pajak Penerangan Jalan (PPJ) adalah pajak yang wajib dibayar oleh pelanggan 
    | listrik PLN. Dimana hasil PPJ tersebut merupakan salah satu Pendapatan Asli 
    | Daerah (PAD) yang digunakan untuk membiayai daerah, termasuk pemasangan dan 
    | pemeliharaan serta pembayaran rekening Penerangan Jalan Umum (PJU) sesuai 
    | kemampuan PEMDA. Lebih lengkapnya lihat di 
    | https://bapenda.jakarta.go.id/pajak-penerangan-jalan/
    | Berikut ini daftar PPJ untuk tiap daerah dalam persen (array key = persen).
    */
  
    'ppj' => [
        '3' => ['JAKARTA', 'BOGOR', 'DEPOK', 'SERANG', 'BATAM'],
        '5' => ['BALI', 'SUKABUMI', 'PALEMBANG', 'MANOKWARI'],
        '6' => ['BANDUNG', 'PEKANBARU', 'INDRAMAYU'],
        '7' => ['MEDAN', 'PANGKAL PINANG', 'KOTA BEKASI', 'KABUPATEN BEKASI'],
        '8' => ['SEMARANG', 'SURABAYA', 'BANJARMASIN', 'LAMPUNG', 'YOGYAKARTA', 'TANJUNGSELOR'],
        '8.5' => ['SIDOARJO'],
        '9' => ['BANDA ACEH', 'PONTIANAK', 'BANYUMAS', 'BANJARNEGARA', 'PURBALINGGA', 'KARANGANYAR'],
        '10' => [
                  'GORONTALO', 'MAKASSAR', 'MAMUJU', 'PALU', 'MOROWALI', 
                  'PALANGKARAYA', 'SAMARINDA', 'AMBON', 'MATARAM', 'KUPANG', 
                  'PADANG', 'KENDARI', 'MANADO', 'BENGKULU', 'BLITAR', 
                  'KEDIRI', 'JEMBER', 'PROBOLINGGO', 'SITUBONDO'
                ],
    ],
];