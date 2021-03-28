<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAduanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('foto_non_valids', 'non_valid_fotos');
        Schema::rename('comment_non_valid_aduans', 'non_valid_comments');
        Schema::rename('foto_bukti_aduans', 'valid_fotos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('non_valid_fotos');
        Schema::dropIfExists('non_valid_comments');
        Schema::dropIfExists('valid_fotos');
    }
}
