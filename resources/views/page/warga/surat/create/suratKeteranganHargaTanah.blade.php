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
                            Nomor Sertifikat
                        </label>
                        <input type="text" name="nomor_sertifikat" placeholder="Contoh. Nomor Sertifikat" required class="single-input" value="{{ old('nomor_sertifikat') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Atas Nama Sertifikat
                        </label>
                        <input type="text" name="atas_nama_sertifikat" placeholder="Contoh. Atas Nama Sertifikat" required class="single-input" value="{{ old('atas_nama_sertifikat') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Luas Tanah
                        </label>
                        <input type="number" name="luas_tanah" placeholder="Contoh. 20 M² (Cukup tulikan angkanya saja, dengan satuan M²)" required class="single-input" value="{{ old('luas_tanah') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Batas Tanah Sebelah Utara
                        </label>
                        <input type="text" name="batas_tanah_utara" placeholder="Contoh. Batas Tanah Sebelah Utara" required class="single-input" value="{{ old('batas_tanah_utara') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Batas Tanah Sebelah Selatan
                        </label>
                        <input type="text" name="batas_tanah_selatan" placeholder="Contoh. Batas Tanah Sebelah Selatan" required class="single-input" value="{{ old('batas_tanah_selatan') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Batas Tanah Sebelah Timur
                        </label>
                        <input type="text" name="batas_tanah_timur" placeholder="Contoh. Batas Tanah Sebelah Timur" required class="single-input" value="{{ old('batas_tanah_timur') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Batas Tanah Sebelah Barat
                        </label>
                        <input type="text" name="batas_tanah_barat" placeholder="Contoh. Batas Tanah Sebelah Barat" required class="single-input" value="{{ old('batas_tanah_barat') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Harga Tafsiran Tanah Saat Ini
                        </label>
                        <input type="number" name="harga_tafsiran_tanah" placeholder="Contoh. Harga Tafsiran Tanah Saat Ini" required class="single-input" value="{{ old('harga_tafsiran_tanah') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Harga Tafsiran Bangunan Rumah Saat Ini
                        </label>
                        <input type="number" name="harga_tafsiran_bangunan" placeholder="Contoh. Harga Tafsiran Bangunan Rumah Saat Ini" required class="single-input" value="{{ old('harga_tafsiran_bangunan') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Berkas Sertifikat Tanah
                        </label>
                        <input type="file" name="fileSertifikatTanah" placeholder="Berkas Sertifikat Tanah" required class="single-input">
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
