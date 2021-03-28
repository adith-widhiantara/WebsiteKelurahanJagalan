<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valid_kepala_comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('valid_aduan_id');
            $table->string('comment');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('valid_rw_comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('valid_aduan_id');
            $table->string('comment');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('valid_warga_comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('valid_aduan_id');
            $table->string('comment');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valid_kepala_comment');
        Schema::dropIfExists('valid_rw_comment');
        Schema::dropIfExists('valid_warga_comment');
    }
}
