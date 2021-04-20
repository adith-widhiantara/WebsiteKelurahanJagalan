<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNomorYangTerteraColumnInSuratBedaNamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_beda_nama', function (Blueprint $table) {
            $table->renameColumn('nomor_yang_tertera', 'nama_yang_tertera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_beda_nama', function (Blueprint $table) {
            $table->renameColumn('nama_yang_tertera', 'nomor_yang_tertera');
        });
    }
}
