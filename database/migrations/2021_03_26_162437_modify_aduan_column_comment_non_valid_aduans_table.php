<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAduanColumnCommentNonValidAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comment_non_valid_aduans', function (Blueprint $table) {
            $table->renameColumn('aduan_id', 'non_valid_aduan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment_non_valid_aduans', function (Blueprint $table) {
            $table->dropColumn('non_valid_aduan_id');
        });
    }
}
