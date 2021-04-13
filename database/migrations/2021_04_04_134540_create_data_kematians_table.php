<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKematiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kematians', function (Blueprint $table) {
            $table->id();
            $table->integer('nama_pelapor_id');
            $table->foreignId('user_id');
            $table->date('tanggal_meninggal');
            $table->string('tempat_meninggal');
            $table->string('sebab_meninggal');
            $table->string('keterangan');
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
        Schema::dropIfExists('data_kematians');
    }
}
