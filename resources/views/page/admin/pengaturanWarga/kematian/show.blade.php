@extends('base.admin')

@section('title')
{{ $dataKematian->user->nama }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kematian.show', $dataKematian) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Detail Data Kematian
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Tanggal Data Dibuat</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataKematian -> created_at)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ $dataKematian -> user -> nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>Usia</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataKematian -> user -> anggota -> tanggal_bulan_tahun_lahir)->age.__(' tahun') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Meninggal</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataKematian -> tanggal_meninggal)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Tempat Meninggal</label>
                    <input type="text" class="form-control" value="{{ $dataKematian -> tempat_meninggal }}" disabled>
                </div>

                <div class="form-group">
                    <label>Sebab Meninggal</label>
                    <input type="text" class="form-control" value="{{ $dataKematian -> sebab_meninggal }}" disabled>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" value="{{ $dataKematian -> keterangan }}" disabled>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $dataKematian -> user -> anggota -> kartu -> nomorkk,'anggotaKeluarga' => $dataKematian -> user -> nomor_ktp]) }}" class="btn btn-success">
                        Detail Warga
                    </a>
                    <a href="{{ route('admin.kematian.show.pdf', $dataKematian -> id) }}" class="btn btn-primary" target="_blank">
                        <i class="far fa-file-pdf"></i>
                        Download sebagai PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
