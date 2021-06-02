@extends('base.admin')

@php
$title = 'Pengaturan Website';
@endphp

@section('title')
{{ $title }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pengaturan.index') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Kontak Person</h3>
            </div>
            <form method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>
                            Alamat Kelurahan
                        </label>
                        <input type="text" class="form-control" name="alamat" value="{{ $data['alamat'] }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Deskripsi Website (Footer)
                        </label>
                        <input type="text" class="form-control" name="deskripsi_website" value="{{ $data['deskripsi'] }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Telepon
                        </label>
                        <input type="text" class="form-control" name="telepon" value="{{ $data['telepon'] }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Text Whatsapp
                        </label>
                        <input type="text" class="form-control" name="whatsapp_text" value="{{ $data['whatsapp_text'] }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Telepon Rumah
                        </label>
                        <input type="text" class="form-control" name="home" value="{{ $data['home'] }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="text" class="form-control" name="email" value="{{ $data['email'] }}" required>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    Pencapaian
                </h3>
            </div>
            <form action="{{ route('admin.pengaturan.store.pencapaian') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Deskripsi Pencapaian
                        </label>
                        <input type="text" class="form-control" name="deskripsi_penghargaan" placeholder="Deskripsi Pencapaian" value="{{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan')->first()->description }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Pencapaian 1
                        </label>
                        <input type="text" class="form-control" name="deskripsi_penghargaan_1" placeholder="Pencapaian 1" value="{{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_1')->first()->description }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Pencapaian 2
                        </label>
                        <input type="text" class="form-control" name="deskripsi_penghargaan_2" placeholder="Pencapaian 2" value="{{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_2')->first()->description }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Pencapaian 3
                        </label>
                        <input type="text" class="form-control" name="deskripsi_penghargaan_3" placeholder="Pencapaian 3" value="{{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_3')->first()->description }}" required>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
