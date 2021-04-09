<?php 

return [
    /*
    |--------------------------------------------------------------------------
    | Status pembayaran
    |--------------------------------------------------------------------------
    |
    | - Success, ‎Transaksi berhasil diselesaikan. Dana telah dikreditkan ke akun Admin.
    | - Failed, Transaksi dapat gagal karena ditolak oleh Midtrans Fraud Detection System (FDS)
    | - Pending, Transaksi telah dibuat dan menunggu untuk dibayar oleh pelanggan
    |   di penyedia pembayaran seperti Debit Langsung, Transfer Bank, E-money, dll.
    | - Expire, Transaksi tidak tersedia untuk diproses, karena pembayaran tertunda.
    | - Cancel, Transaksi dibatalkan karena 
    |    1. Pihak bank membatalkan transaksi, karena ada suatu kecurigaan
    |    2. Pelanggan mengubah metode pembayaran
    */

    'payment_status' => ['success', 'failed', 'pending', 'expire', 'cancel'],
];