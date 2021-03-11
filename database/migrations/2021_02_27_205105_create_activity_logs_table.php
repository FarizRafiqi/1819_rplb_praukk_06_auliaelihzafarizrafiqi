<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel ini digunakan untuk memantau kejadian/events seperti (insert, update, dan delete)
 * dari suatu tabel, atau dalam bahasa kerennya adalah activity logs
 */
class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable(); //User mana yang melakukan suatu event
            $table->string('tabel_referensi'); //Tabel mana yang sedang di track aktivitasnya
            $table->unsignedBigInteger('id_referensi')->nullable(); //Record (baris) mana dari tabel yang di referensikan
            $table->text('deskripsi'); // Apa yang dilakukan oleh mereka
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
        Schema::dropIfExists('activity_logs');
    }
}
