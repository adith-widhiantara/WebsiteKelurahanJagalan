<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyJenisAduanColumnToAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->renameColumn('jenis__aduan_id', 'jenis_aduan_id');
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
            $table->dropColumn('jenis_aduan_id');
        });
    }
}
