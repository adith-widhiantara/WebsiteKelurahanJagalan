@extends('base.admin')

@php
$title = 'Detail Data Pindah Keluar';
@endphp

@section('title')
{{ $title }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pindahkeluar.show', $dataPindahKeluar) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $title }}
                </h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label>
                        Tanggal Data Dibuat
                    </label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataPindahKeluar -> created_at)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nama
                    </label>
                    <input type="text" class="form-control" value="{{ $dataPindahKeluar -> user -> nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor KK
                    </label>
                    <input type="text" class="form-control" value="{{ $dataPindahKeluar -> user -> anggota -> kartu -> nomorkk }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor KTP
                    </label>
                    <input type="text" class="form-control" value="{{ $dataPindahKeluar -> user -> nomor_ktp }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Alamat Tujuan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataPindahKeluar -> alamat_tujuan }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Tanggal Surat
                    </label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dataPindahKeluar -> tanggal_surat)->isoFormat('dddd, D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor Surat
                    </label>
                    <input type="text" class="form-control" value="{{ $dataPindahKeluar -> nomor_surat }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Berkas Surat Pindah Keluar
                    </label>
                    <a href="{{ route('admin.pindahkeluar.show.file', $dataPindahKeluar -> id) }}" class="btn btn-primary btn-block" target="blank">Lihat Surat</a>
                </div>

                <div class="form-group">
                    <label>
                        Keterangan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataPindahKeluar -> keterangan }}" disabled>
                </div>

            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $dataPindahKeluar -> user -> anggota -> kartu -> nomorkk,'anggotaKeluarga' => $dataPindahKeluar -> user -> nomor_ktp]) }}" class="btn btn-success">
                        Detail Warga
                    </a>
                    <a href="{{ route('admin.pindahkeluar.show.pdf', $dataPindahKeluar -> id) }}" class="btn btn-primary" target="_blank">
                        <i class="far fa-file-pdf"></i>
                        Download sebagai PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
