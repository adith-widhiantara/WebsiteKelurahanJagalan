<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Landing
Breadcrumbs::for('admin.index', function ($trail) {
    $trail->push('Panel Website', route('admin.index'));
});

Breadcrumbs::for('admin.news.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Berita', route('admin.news.index'));
});

// News show.warga
Breadcrumbs::for('admin.news.show', function ($trail, $news) {
    $trail->parent('admin.news.index');
    $trail->push($news->title, route('admin.news.show', $news->slug));
});

// news create
Breadcrumbs::for('admin.news.create', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Buat Berita', route('admin.news.create'));
});

// Category index
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Kategory Berita', route('admin.category.index'));
});

// category show
Breadcrumbs::for('admin.category.show', function ($trail, $category) {
    $trail->parent('admin.category.index');
    $trail->push($category->name, route('admin.category.show', $category->slug));
});

// aduan index
Breadcrumbs::for('admin.aduan.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Aduan Masyarakat', route('admin.aduan.index'));
});

// aduan belum selesai index
Breadcrumbs::for('admin.aduan.thisMonthIndex', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Aduan Bulan Ini', route('admin.aduan.thisMonthIndex'));
});

// tindak lanjut aduan
Breadcrumbs::for('admin.aduan.tindaklanjut.index', function ($trail) {
    $trail->parent('admin.aduan.index');
    $trail->push('Daftar Aduan Tindak Lanjut', route('admin.aduan.tindaklanjut.index'));
});

// aduan show
Breadcrumbs::for('admin.aduan.show', function ($trail, $aduan) {
    $trail->parent('admin.aduan.index');
    $trail->push($aduan->judul_masalah, route('admin.aduan.show', $aduan->slug));
});

// aduan show timeline
Breadcrumbs::for('admin.aduan.timeline', function ($trail, $aduan) {
    $trail->parent('admin.aduan.show', $aduan);
    $trail->push('Timeline', route('admin.aduan.timeline', $aduan->slug));
});

// kartu keluarga index
Breadcrumbs::for('admin.kartukeluarga.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Kartu Keluarga', route('admin.kartukeluarga.index'));
});

// kartu keluarga list warga
Breadcrumbs::for('admin.kartukeluarga.warga', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Warga Kelurahan', route('admin.kartukeluarga.warga'));
});

// kartu keluarga show
Breadcrumbs::for('admin.kartukeluarga.show', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.kartukeluarga.index');
    $trail->push($kartuKeluarga->nomorkk, route('admin.kartukeluarga.show', $kartuKeluarga->nomorkk));
});

// anggota keluarga create
Breadcrumbs::for('admin.kartukeluarga.anggota.create', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.kartukeluarga.show', $kartuKeluarga);
    $trail->push('Pendaftaran Anggota Keluarga', route('admin.kartukeluarga.anggota.create', $kartuKeluarga->nomorkk));
});

// anggota keluarga show
Breadcrumbs::for('admin.kartukeluarga.anggota.show', function ($trail, $kartuKeluarga, $biodataAnggota) {
    $trail->parent('admin.kartukeluarga.show', $kartuKeluarga);
    $trail->push($biodataAnggota->nama, route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $kartuKeluarga->nomorkk, 'anggotaKeluarga' => $biodataAnggota->nomor_ktp]));
});

// tabel kartu keluarga
Breadcrumbs::for('admin.tabelkartukeluarga.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Tabel Kartu Keluarga', route('admin.tabelkartukeluarga.index'));
});

// kartu keluarga create
Breadcrumbs::for('admin.kartukeluarga.create', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Buat Kartu Keluarga', route('admin.kartukeluarga.create'));
});

// data kelahiran index
Breadcrumbs::for('admin.kelahiran.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Data Kelahiran Warga', route('admin.kelahiran.index'));
});

// data kelahiran create
Breadcrumbs::for('admin.kelahiran.create', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.kelahiran.index');
    $trail->push('Buat Data Kelahiran', route('admin.kelahiran.create', $kartuKeluarga->nomorkk));
});

// data kelahiran create new
Breadcrumbs::for('admin.kelahiran.create.new', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.kelahiran.create', $kartuKeluarga);
    $trail->push('Buat Anggota Keluarga Baru', route('admin.kelahiran.create.new', $kartuKeluarga->nomorkk));
});

// data kelahiran show
Breadcrumbs::for('admin.kelahiran.show', function ($trail, $dataKelahiran) {
    $trail->parent('admin.kelahiran.index');
    $trail->push('Detail Data Kelahiran Warga', route('admin.kelahiran.show', $dataKelahiran->id));
});

// data kematian index
Breadcrumbs::for('admin.kematian.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Data Kematian Warga', route('admin.kematian.index'));
});

// data kematian create
Breadcrumbs::for('admin.kematian.create', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.kematian.index');
    $trail->push('Buat Data Kematian Warga', route('admin.kematian.create', $kartuKeluarga->nomorkk));
});

// data kematian show
Breadcrumbs::for('admin.kematian.show', function ($trail, $dataKematian) {
    $trail->parent('admin.kematian.index');
    $trail->push('Detail Data Kematian Warga', route('admin.kematian.show', $dataKematian->id));
});

// data pindah masuk index
Breadcrumbs::for('admin.pindahmasuk.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Data Pindah Masuk', route('admin.pindahmasuk.index'));
});

// data pindah masuk create
Breadcrumbs::for('admin.pindahmasuk.create', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.pindahmasuk.index');
    $trail->push('Buat Data Pindah Masuk', route('admin.pindahmasuk.create', $kartuKeluarga->nomorkk));
});

// data pindah masuk create new
Breadcrumbs::for('admin.pindahmasuk.create.new', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.pindahmasuk.index');
    $trail->push('Buat Data Pindah Masuk Anggota Baru', route('admin.pindahmasuk.create.new', $kartuKeluarga->nomorkk));
});

// data pindah masuk show
Breadcrumbs::for('admin.pindahmasuk.show', function ($trail, $dataPindahMasuk) {
    $trail->parent('admin.pindahmasuk.index');
    $trail->push('Detail Data Pindah Masuk', route('admin.pindahmasuk.show', $dataPindahMasuk->id));
});

// data pindah keluar index
Breadcrumbs::for('admin.pindahkeluar.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Data Pindah Keluar', route('admin.pindahkeluar.index'));
});

// data pindah keluar create
Breadcrumbs::for('admin.pindahkeluar.create', function ($trail, $kartuKeluarga) {
    $trail->parent('admin.pindahkeluar.index');
    $trail->push('Buat Data Pindah Keluar', route('admin.pindahkeluar.create', $kartuKeluarga->nomorkk));
});

// data pindah keluar show
Breadcrumbs::for('admin.pindahkeluar.show', function ($trail, $dataPindahKeluar) {
    $trail->parent('admin.pindahkeluar.index');
    $trail->push('Detail Data Pindah Keluar', route('admin.pindahkeluar.show', $dataPindahKeluar->id));
});

// surat index
Breadcrumbs::for('admin.surat.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Seluruh Permintaan Surat Warga', route('admin.surat.index'));
});

// surat create
Breadcrumbs::for('admin.surat.create', function ($trail, $dataJenisSurat) {
    $trail->parent('admin.surat.index');
    $trail->push($dataJenisSurat->nama_surat, route('admin.surat.create', $dataJenisSurat->id));
});

// surat show
Breadcrumbs::for('admin.surat.show', function ($trail, $dataSurat) {
    $trail->parent('admin.surat.index');
    $trail->push($dataSurat->jenis->nama_surat, route('admin.surat.show', $dataSurat->id));
});

// jenis surat index
Breadcrumbs::for('admin.jenis.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Jenis Pelayanan Surat', route('admin.jenis.index'));
});

// jenis surat list
Breadcrumbs::for('admin.jenis.list', function ($trail, $jenisSurat) {
    $trail->parent('admin.jenis.index');
    $trail->push($jenisSurat->nama_surat, route('admin.jenis.list', $jenisSurat->id));
});

// jenis surat show
Breadcrumbs::for('admin.jenis.show', function ($trail, $jenisSurat) {
    $trail->parent('admin.jenis.list', $jenisSurat);
    $trail->push('Lihat data', route('admin.jenis.show', $jenisSurat->id));
});

// antrian index today
Breadcrumbs::for('admin.antrian.index.today', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Antrian Hari Ini', route('admin.antrian.index.today'));
});

// antrian index today
Breadcrumbs::for('admin.antrian.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Seluruh Antrian Warga', route('admin.antrian.index'));
});

// pengurus index
Breadcrumbs::for('admin.pengurus.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Pengguna & Pengurus Website', route('admin.pengurus.index'));
});

// pengurus create
Breadcrumbs::for('admin.pengurus.create', function ($trail) {
    $trail->parent('admin.pengurus.index');
    $trail->push('Daftarkan Pengurus', route('admin.pengurus.create'));
});

// pengurus show
Breadcrumbs::for('admin.pengurus.show.pegawai', function ($trail, $user) {
    $trail->parent('admin.pengurus.index');
    $trail->push($user->nama, route('admin.pengurus.show.pegawai', $user->id));
});

// pengurus kepala kelurahan create
Breadcrumbs::for('admin.pengurus.kepalakelurahan.create.new', function ($trail) {
    $trail->parent('admin.pengurus.index');
    $trail->push('Pendataan Kepala Kelurahan', route('admin.pengurus.kepalakelurahan.create.new'));
});

// pengurus RW RT create
Breadcrumbs::for('admin.pengurus.rukunWarga.create', function ($trail) {
    $trail->parent('admin.pengurus.index');
    $trail->push('Pendataan RW dan RT', route('admin.pengurus.rukunWarga.create'));
});

// pengurus RW RT show
Breadcrumbs::for('admin.pengurus.dataRtRw.show', function ($trail, $user) {
    $trail->parent('admin.pengurus.index');
    $trail->push($user->nama, route('admin.pengurus.dataRtRw.show', $user->nomor_ktp));
});

// pengurus profil saya
Breadcrumbs::for('admin.pengurus.profilSaya', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Profil Saya', route('admin.pengurus.profilSaya'));
});

// pengaturan website index
Breadcrumbs::for('admin.pengaturan.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Pengaturan Website', route('admin.pengaturan.index'));
});
