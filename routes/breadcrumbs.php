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
