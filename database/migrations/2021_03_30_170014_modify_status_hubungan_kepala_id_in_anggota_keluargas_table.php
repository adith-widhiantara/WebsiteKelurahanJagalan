<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusHubunganKepalaIdInAnggotaKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggota_keluargas', function (Blueprint $table) {
            $table->renameColumn('status_hubungan_dengan_kepala_keluarga_id', 'status_hubungan_kepala_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggota_keluargas', function (Blueprint $table) {
            $table->foreignId('status_hubungan_dengan_kepala_keluarga_id')->after('tanggal_perceraian');
        });
    }
}
