<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPenghasilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_penghasilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_administrasi_id')->constrained('surat_administrasi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('penghasilan');
            $table->string('bukti_penghasilan')->nullable();
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
        Schema::dropIfExists('surat_penghasilan');
    }
}
