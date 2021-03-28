<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAduanIdColumnInValidFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('valid_fotos', function (Blueprint $table) {
            $table->renameColumn('aduan_id', 'valid_aduan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valid_fotos', function (Blueprint $table) {
            $table->dropColumn('valid_aduan_id');
        });
    }
}
