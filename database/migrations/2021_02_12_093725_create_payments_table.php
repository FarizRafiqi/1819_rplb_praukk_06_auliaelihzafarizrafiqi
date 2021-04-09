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
            $table->uuid('id')->unique();
            $table->foreignId('id_customer')->constrained('users')->onUpdate('cascade');
            $table->foreignId('id_pelanggan_pln')->constrained('pln_customers')->onUpdate('cascade');
            $table->dateTime('tanggal_bayar', 0);
            $table->decimal('biaya_admin', 10, 2);
            $table->decimal('total_bayar', 10, 2);
            $table->foreignId('id_bank')->nullable()->constrained('users')->onUpdate('cascade');
            $table->foreignId('id_metode_pembayaran')->nullable()->constrained('payment_methods')->onUpdate('cascade');
            $table->enum('status', ['success', 'failed', 'pending', 'expire', 'cancel'])->default(null);
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
