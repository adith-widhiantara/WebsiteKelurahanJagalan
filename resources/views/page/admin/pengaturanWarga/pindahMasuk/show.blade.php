@extends('base.admin')

@php
$title = 'Detail Data Pindah Masuk';
@endphp

@section('title')
{{ $title }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pindahmasuk.show', $dataPindahMasuk) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $title }}
                </h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label>Tanggal Data Dibuat</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataPindahMasuk -> created_at)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ $dataPindahMasuk -> user -> nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nomor KTP</label>
                    <input type="text" class="form-control" value="{{ $dataPindahMasuk -> user -> nomor_ktp }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nomor KK</label>
                    <input type="text" class="form-control" value="{{ $dataPindahMasuk -> user -> anggota -> kartu -> nomorkk }}" disabled>
                </div>

                <div class="form-group">
                    <label>Alamat Asal</label>
                    <input type="text" class="form-control" value="{{ $dataPindahMasuk -> alamat_asal }}" disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataPindahMasuk -> tanggal_surat)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" class="form-control" value="{{ $dataPindahMasuk -> nomor_surat }}" disabled>
                </div>

                <div class="form-group">
                    <label>Berkas Pindah Datang</label>
                    <a href="{{ route('admin.pindahmasuk.show.file', $dataPindahMasuk -> id) }}" class="btn btn-primary btn-block" target="blank"> Lihat Surat </a>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" value="{{ $dataPindahMasuk -> keterangan }}" disabled>
                </div>

            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $dataPindahMasuk -> user -> anggota -> kartu -> nomorkk,'anggotaKeluarga' => $dataPindahMasuk -> user -> nomor_ktp]) }}" class="btn btn-success">
                        Detail Warga
                    </a>
                    <a href="{{ route('admin.pindahmasuk.show.pdf', $dataPindahMasuk->id) }}" class="btn btn-primary">
                        <i class="far fa-file-pdf"></i>
                        Download sebagai PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
