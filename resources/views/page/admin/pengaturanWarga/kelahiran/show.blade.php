@extends('base.admin')

@section('title')
{{ $dataKelahiran->user->nama }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kelahiran.show', $dataKelahiran) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Detail Data Kelahiran
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Tanggal Data Dibuat</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataKelahiran -> created_at)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ $dataKelahiran -> user -> nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataKelahiran -> user -> anggota -> tanggal_bulan_tahun_lahir)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Usia</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataKelahiran -> user -> anggota -> tanggal_bulan_tahun_lahir)->age.__(' tahun') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nomor Anak</label>
                    <input type="text" class="form-control" value="{{ $dataKelahiran -> nomor_anak }}" disabled>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" value="{{ $dataKelahiran -> keterangan }}" disabled>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $dataKelahiran -> user -> anggota -> kartu -> nomorkk,'anggotaKeluarga' => $dataKelahiran -> user -> nomor_ktp]) }}" class="btn btn-success">
                        Detail Warga
                    </a>
                    <a href="{{ route('admin.kelahiran.show.pdf', $dataKelahiran -> id) }}" class="btn btn-primary">
                        <i class="far fa-file-pdf"></i>
                        Download sebagai PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
