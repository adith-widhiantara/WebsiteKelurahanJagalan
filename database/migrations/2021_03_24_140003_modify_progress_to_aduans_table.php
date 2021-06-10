<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProgressToAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->integer('progress')->default(0)->after('detail_pengaduan')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->integer('progress')->after('detail_pengaduan')->change();
        });
    }
}
