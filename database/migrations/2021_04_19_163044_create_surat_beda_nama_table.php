<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratBedaNamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_beda_nama', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_administrasi_id')->constrained('surat_administrasi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('jenis_surat');
            $table->string('nomor_yang_tertera');
            $table->string('nomor_surat_tersebut');
            $table->string('file_surat')->nullable();
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
        Schema::dropIfExists('surat_beda_nama');
    }
}
