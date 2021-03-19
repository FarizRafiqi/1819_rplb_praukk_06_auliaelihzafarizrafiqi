<?php 

return [
    /*
    |--------------------------------------------------------------------------
    | Status pembayaran
    |--------------------------------------------------------------------------
    |
    | - Success, ‎Transaksi berhasil diselesaikan. Dana telah dikreditkan ke akun Admin.
    | - Failed, Transaksi dapat gagal karena
    |    1. dibatalkan oleh pengguna/level/pihak yang berwenang yang mengurusi data pembayaran (ex: Level Bank), 
    |    2. ditolak oleh Midtrans Fraud Detection System (FDS)
    | - Pending, Transaksi telah dibuat dan menunggu untuk dibayar oleh pelanggan
    |   di penyedia pembayaran seperti Debit Langsung, Transfer Bank, E-money, dll.
    | - Expire, Transaksi tidak tersedia untuk diproses, karena pembayaran tertunda.
    */

    'payment_status' => ['success', 'failed', 'pending', 'expire'],
];