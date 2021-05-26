@extends('base.admin')

@section('title')
Lihat Data Pengurus
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pengurus.show.pegawai', $user) }}
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

                    <a href="#" class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('hapusPengurusKelurahanForm').submit()">
                        Hapus Dari Pengurus Kelurahan
                    </a>

                    <form id="hapusPengurusKelurahanForm" action="#" method="post" style="display: none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
