<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKeteranganColumnIn4Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kelahirans', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->change();
        });

        Schema::table('data_kematians', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->change();
        });

        Schema::table('data_pindah_masuks', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->change();
        });

        Schema::table('data_pindah_keluars', function (Blueprint $table) {
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_kelahirans', function (Blueprint $table) {
            $table->string('keterangan')->change();
        });

        Schema::table('data_kematians', function (Blueprint $table) {
            $table->string('keterangan')->change();
        });

        Schema::table('data_pindah_masuks', function (Blueprint $table) {
            $table->string('keterangan')->change();
        });

        Schema::table('data_pindah_keluars', function (Blueprint $table) {
            $table->string('keterangan')->change();
        });
    }
}
