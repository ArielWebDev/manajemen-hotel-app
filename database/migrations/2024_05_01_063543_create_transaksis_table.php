<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kamar_id');
            $table->string('nama_pengunjung')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->decimal('biaya', 10, 2);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kamar_id')->references('id')->on('kamar');
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
        Schema::dropIfExists('transaksi');
    }
}
