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
                <form action="{{ route('warga.surat.store', $jenisSurat->slug) }}" method="POST">
                    @csrf
                    <div class="mt-10">
                        <label>
                            Anda bekerja sejak tahun berapa?
                        </label>
                        <input type="text" name="sejak" placeholder="Contoh. 2009" required class="single-input" value="{{ old('sejak') }}">
                    </div>

                    <div class="mt-10">
                        <label>
                            Keperluan
                        </label>
                        <input type="text" name="keperluan" placeholder="Contoh. Keperluan" required class="single-input" value="{{ old('keperluan') }}">
                    </div>

                    <div class="mt-10">
                        <label>
                            Pesan
                        </label>
                        <input type="text" name="pesan" placeholder="Contoh. Pesan" required class="single-input" value="{{ old('pesan') }}">
                    </div>

                    <div class="mt-10">
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
