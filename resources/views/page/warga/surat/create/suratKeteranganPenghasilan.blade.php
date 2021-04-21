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
                            Penghasilan
                        </label>
                        <input type="text" name="penghasilan" placeholder="Contoh. 4000000" required class="single-input" value="{{ old('penghasilan') }}">
                    </div>

                    <div class="mt-40">
                        <label>
                            Bukti Penghasilan
                        </label>
                        <input type="file" name="bukti_penghasilan" placeholder="Bukti Penghasilan" required class="single-input">
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
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
