<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penggunaan')->nullable()
                    ->constrained('usages')
                    ->onUpdate('cascade');
            $table->string('bulan', 10);
            $table->year('tahun', 4);
            $table->integer('jumlah_kwh');
            $table->enum('status', ['BELUM LUNAS', 'LUNAS']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
