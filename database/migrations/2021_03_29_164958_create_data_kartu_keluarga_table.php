<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKartuKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluarga_gelar', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_golongan_darah', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_agama', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_status_perkawinan', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_status_hubungan_dengan_kepala_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_penyandang_cacat', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_pendidikan_terakhir', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_pekerjaan', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('kartu_keluarga_gelar');
        Schema::dropIfExists('kartu_keluarga_golongan_darah');
        Schema::dropIfExists('kartu_keluarga_agama');
        Schema::dropIfExists('kartu_keluarga_status_perkawinan');
        Schema::dropIfExists('kartu_keluarga_status_hubungan_dengan_kepala_keluarga');
        Schema::dropIfExists('kartu_keluarga_penyandang_cacat');
        Schema::dropIfExists('kartu_keluarga_pendidikan_terakhir');
        Schema::dropIfExists('kartu_keluarga_pekerjaan');
    }
}
