<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratHargaTanahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_harga_tanah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_administrasi_id')->constrained('surat_administrasi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nomor_sertifikat');
            $table->string('atas_nama_sertifikat');
            $table->string('luas_tanah');
            $table->string('batas_tanah_utara');
            $table->string('batas_tanah_selatan');
            $table->string('batas_tanah_timur');
            $table->string('batas_tanah_barat');
            $table->string('harga_tafsiran_tanah');
            $table->string('harga_tafsiran_bangunan');
            $table->string('fileSertifikatTanah')->nullable();
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
        Schema::dropIfExists('surat_harga_tanah');
    }
}
