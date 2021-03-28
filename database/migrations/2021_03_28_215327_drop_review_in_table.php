<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropReviewInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('valid_kepala_comment', function (Blueprint $table) {
            $table->dropColumn('review');
        });

        Schema::table('valid_warga_comment', function (Blueprint $table) {
            $table->dropColumn('review');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valid_kepala_comment', function (Blueprint $table) {
            $table->integer('review')->after('comment')->nullable();
        });

        Schema::table('valid_warga_comment', function (Blueprint $table) {
            $table->integer('review')->after('comment')->nullable();
        });
    }
}
