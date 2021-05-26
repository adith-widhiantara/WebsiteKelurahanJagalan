<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyingUsersDataPengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_data_pengurus', function (Blueprint $table) {
            $table->boolean('warga_jagalan')->nullable()->change();
            $table->string('bagian_kerja')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_data_pengurus', function (Blueprint $table) {
            $table->boolean('warga_jagalan')->change();
            $table->string('bagian_kerja')->change();
        });
    }
}
