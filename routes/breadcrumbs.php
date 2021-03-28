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
