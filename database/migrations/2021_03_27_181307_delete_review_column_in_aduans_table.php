<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteReviewColumnInAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->dropColumn('review');
        });

        Schema::table('valid_warga_comment', function (Blueprint $table) {
            $table->integer('review')->after('comment')->nullable();
            $table->string('comment')->after('valid_aduan_id')->nullable()->change();
            $table->string('user_id')->after('review')->nullable()->change();
        });

        Schema::table('valid_kepala_comment', function (Blueprint $table) {
            $table->integer('review')->after('comment')->nullable();
            $table->string('comment')->after('valid_aduan_id')->nullable()->change();
            $table->string('user_id')->after('review')->nullable()->change();
        });

        Schema::table('valid_rw_comment', function (Blueprint $table) {
            $table->integer('status')->after('comment')->default(0);
            $table->string('comment')->after('valid_aduan_id')->nullable()->change();
            $table->string('user_id')->after('status')->nullable()->change();
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
            $table->integer('review')->after('progress')->nullable();
        });

        Schema::table('valid_warga_comment', function (Blueprint $table) {
            $table->dropColumn('review');
        });

        Schema::table('valid_kepala_comment', function (Blueprint $table) {
            $table->dropColumn('review');
        });

        Schema::table('valid_rw_comment', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
