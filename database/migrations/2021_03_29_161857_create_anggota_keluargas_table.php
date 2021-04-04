<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kartu_keluarga_id');
            $table->foreignId('gelar_id');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_bulan_tahun_lahir');
            $table->enum('surat_lahir', ['Ada', 'Tidak Ada']);
            $table->string('nomor_surat_lahir')->nullable();
            $table->foreignId('golongan_darah_id');
            $table->foreignId('agama_id');
            $table->string('kepercayaan_terhadap_tuhan_yang_maha_esa')->nullable();
            $table->foreignId('status_perkawinan_id');
            $table->enum('buku_nikah', ['Ada', 'Tidak Ada']);
            $table->string('nomor_buku_nikah')->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->enum('surat_cerai', ['Ada', 'Tidak Ada']);
            $table->string('nomor_surat_cerai')->nullable();
            $table->date('tanggal_perceraian')->nullable();
            $table->foreignId('status_hubungan_dengan_kepala_keluarga_id');
            $table->enum('kelainan_fisik', ['Ada', 'Tidak Ada']);
            $table->foreignId('penyandang_cacat_id');
            $table->foreignId('pendidikan_terakhir_id');
            $table->foreignId('pekerjaan_id');
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu');
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah');
            $table->integer('creator_id');
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
        Schema::dropIfExists('anggota_keluargas');
    }
}
