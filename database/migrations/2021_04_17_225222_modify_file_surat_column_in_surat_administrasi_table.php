<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFileSuratColumnInSuratAdministrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_administrasi', function (Blueprint $table) {
            $table->string('file_surat')->nullable()->change();
            $table->boolean('status')->after('pesan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_administrasi', function (Blueprint $table) {
            $table->string('file_surat')->change();
            $table->dropColumn('status');
        });
    }
}
