<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS payment_histories");
        DB::statement("
            CREATE VIEW payment_histories AS  
                SELECT  
                    payments.*,
                    payment_details.id_pembayaran,
                    payment_details.id_tagihan,
                    payment_details.denda,
                    users.nama,  
                    pc.nama_pelanggan  
                FROM  
                    payments  
                INNER JOIN  
                    users  
                ON payments.id_customer = users.id  
                INNER JOIN  
                    pln_customers AS pc  
                ON payments.id_pelanggan_pln = pc.id
                INNER JOIN payment_details
                    ON payments.id = payment_details.id_pembayaran
                ORDER BY tanggal_bayar DESC"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS payment_histories");
    }
}
