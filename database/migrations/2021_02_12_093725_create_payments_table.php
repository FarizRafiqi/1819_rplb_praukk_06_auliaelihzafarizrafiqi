<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('users')->onUpdate('cascade');
            $table->foreignId('id_pelanggan_pln')->constrained('pln_customers')->onUpdate('cascade');
            $table->foreignId('id_tagihan')->constrained('bills')->onUpdate('cascade');
            $table->dateTime('tanggal_bayar', 0);
            $table->decimal('biaya_admin', 10, 3);
            $table->decimal('denda', 10, 3);
            $table->decimal('total_bayar', 10, 3);
            $table->foreignId('id_admin')->constrained('users')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}