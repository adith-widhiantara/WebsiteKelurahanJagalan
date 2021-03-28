<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliedAtColumnCommentRwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('valid_rw_comment', function (Blueprint $table) {
            $table->dateTime('applied_at')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valid_rw_comment', function (Blueprint $table) {
            $table->dropColumn('applied_at');
        });
    }
}
