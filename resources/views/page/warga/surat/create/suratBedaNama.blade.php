@extends('base.base')

@php
$title = 'Buat ' . $jenisSurat->nama_surat;
@endphp

@section('title')
{{ $title }}
@endsection

@section('base')
{{-- slider --}}
@include('page.aduan.part.slider', ['title' => $title])
{{-- end slider --}}

<div class="container-fluid">
    <div class="section-top-border">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <h3 class="mb-30">Buat Pengajuan {{ $jenisSurat->nama_surat }} Anda</h3>
                <form action="{{ route('warga.surat.store', $jenisSurat->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-40">
                        <label>
                            Jenis Surat
                        </label>
                        <input type="text" name="jenis_surat" placeholder="Contoh. Kartu Indonesia Pintar" required class="single-input" value="{{ old('jenis_surat') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Nama Yang Tertera Pada Surat Tersebut
                        </label>
                        <input type="text" name="nama_yang_tertera" placeholder="Contoh. Nama Yang Tertera Pada Surat Tersebut" required class="single-input" value="{{ old('nama_yang_tertera') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Nomor Surat Tersebut
                        </label>
                        <input type="text" name="nomor_surat_tersebut" placeholder="Contoh. Nomor Surat Tersebut" required class="single-input" value="{{ old('nomor_surat_tersebut') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Berkas Jenis Surat
                        </label>
                        <input type="file" name="file_surat" placeholder="Berkas Jenis Surat" required class="single-input">
                    </div>

                    <div class="mt-40">
                        <label>
                            Keperluan
                        </label>
                        <input type="text" name="keperluan" placeholder="Contoh. Keperluan" required class="single-input" value="{{ old('keperluan') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Pesan
                        </label>
                        <input type="text" name="pesan" placeholder="Contoh. Pesan" required class="single-input" value="{{ old('pesan') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Keterangan
                        </label>
                        <input type="text" name="keterangan" placeholder="Contoh. Keterangan" required class="single-input" value="{{ old('keterangan') }}">
                    </div>

                    <button type="submit" class="btn mt-5 float-right">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
