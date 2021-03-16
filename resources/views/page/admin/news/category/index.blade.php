@extends('base.admin')

@section('title')
Kategori Berita
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.category.index') }}
@endsection

@section('base')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Kategori Berita</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Kategori</th>
                    <th>Banyak Berita</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $cat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cat -> name }}</td>
                    <td>{{ $cat -> news -> count() }}</td>
                    <td>
                        <a href="{{ route('admin.category.show', $cat->slug) }}" class="btn btn-xs btn-primary">
                            Lihat Berita
                        </a>
                        <a href="#" class="btn btn-xs btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection