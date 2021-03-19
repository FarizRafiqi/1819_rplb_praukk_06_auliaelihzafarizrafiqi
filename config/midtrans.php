<?php 
  
return [
    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Midtrans
    |--------------------------------------------------------------------------
    |
    | Konfigurasi ini dipakai setiap kali ingin berinteraksi dengan Midtrans
    */
    
    'serverKey' => env('MIDTRANS_SERVER_KEY', null),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
];