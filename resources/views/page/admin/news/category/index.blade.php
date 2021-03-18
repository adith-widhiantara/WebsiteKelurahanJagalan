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
        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#create-category">
            Tambah Kategori
        </a>

        <div class="modal fade" id="create-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Buat Kategori Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama kategori" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                            Lihat Kategori
                        </a>
                        <a href="#" class="btn btn-xs btn-warning" data-toggle="modal"
                            data-target="#edit-category-{{ $cat->id }}">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($category as $cat)
        <div class="modal fade" id="edit-category-{{ $cat->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.category.put', $cat->slug) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama kategori" name="name"
                                    required value="{{ $cat->name }}">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection