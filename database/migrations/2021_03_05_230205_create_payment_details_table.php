<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembayaran')->constrained('payments')->onUpdate('cascade');
            $table->foreignId('id_tagihan')->constrained('bills')->onUpdate('cascade');
            $table->decimal('denda', 10, 2)->default(0);
            $table->decimal('ppn', 10, 2)->default(0);
            $table->decimal('ppj', 10, 2)->default(0);
            $table->decimal('total_tagihan', 10, 2)->default(0);
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
        Schema::dropIfExists('payment_details');
    }
}
