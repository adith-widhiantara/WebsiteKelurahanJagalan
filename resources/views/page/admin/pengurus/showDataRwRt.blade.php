@extends('base.admin')

@section('title')
Detail RT dan RW
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pengurus.dataRtRw.show', $user) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Lihat Data Pengurus
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>
                        Nama
                    </label>
                    <input type="text" class="form-control" value="{{ $user -> nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor KTP
                    </label>
                    <input type="text" class="form-control" value="{{ $user -> nomor_ktp }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Bagian Kerja
                    </label>
                    @if ($user->nomor_ktp == 'admin')
                    <input type="text" class="form-control" value="{{ __('Admin') }}" disabled>
                    @else
                    <input type="text" class="form-control" value="{{ $user -> pengurus -> bagian_kerja }}" disabled>
                    @endif
                </div>

                <div class="form-group">
                    <label>
                        Nomor Telepon
                    </label>
                    <input type="text" class="form-control" value="{{ $user -> nomor_telepon }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Email
                    </label>
                    <input type="text" class="form-control" value="{{ $user -> email }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Alamat
                    </label>
                    <input type="text" class="form-control" value="{{ $user -> pengurus -> alamat ? $user -> pengurus -> alamat : $user -> anggota -> kartu -> alamat }}" disabled>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <a href="{{ route('admin.kartukeluarga.show', $user->anggota->kartu->nomorkk) }}" class="btn btn-primary">
                        Lihat Kartu Keluarga
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
