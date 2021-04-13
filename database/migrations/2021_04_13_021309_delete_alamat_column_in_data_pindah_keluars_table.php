<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteAlamatColumnInDataPindahKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_pindah_keluars', function (Blueprint $table) {
            $table->dropColumn('alamat_asal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_pindah_keluars', function (Blueprint $table) {
            $table->string('alamat_asal')->after('user_id');
        });
    }
}
