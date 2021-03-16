<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Landing
Breadcrumbs::for('admin.index', function ($trail) {
    $trail->push('Panel Website', route('admin.index'));
});

// News index.warga
Breadcrumbs::for('admin.news.warga', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Berita Warga', route('admin.news.warga'));
});

// News index.kelurahan
Breadcrumbs::for('admin.news.kelurahan', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Berita Kelurahan', route('admin.news.kelurahan'));
});

// Category index
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Daftar Kategory Berita', route('admin.category.index'));
});

// news create
Breadcrumbs::for('admin.news.create', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Buat Berita', route('admin.news.create'));
});

// category show
Breadcrumbs::for('admin.category.show', function ($trail, $category) {
    $trail->parent('admin.category.index');
    $trail->push($category->name, route('admin.category.show', $category->slug));
});
