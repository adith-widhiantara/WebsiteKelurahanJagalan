@extends('base.base')

@php
$title = 'Buat Aduan';
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
                <h3 class="mb-30">Buat Aduan Anda</h3>
                <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-10">
                        <input type="text" name="judul_masalah" placeholder="Apa Aduan Anda?" required class="single-input" value="{{ old('judul_masalah') }}">
                    </div>

                    <div class="mt-10">
                        <input type="file" name="foto[]" placeholder="Foto Kejadian" required class="single-input" multiple>
                    </div>

                    <div class="input-group-icon mt-10">
                        <div class="icon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                        <div class="form-select" id="default-select">
                            <select name="jenis_aduan_id">
                                <option value="">Kategori Aduan Anda</option>
                                @foreach (\App\Models\Aduan\JenisAduan::all() as $jenisAduan)
                                <option value="{{ $jenisAduan -> id }}">{{ $jenisAduan -> nama_aduan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-10">
                        <textarea class="single-textarea" name="detail_pengaduan" placeholder="Jelaskan Aduan Anda" required>{{ old('detail_pengaduan') }}</textarea>
                    </div>

                    <button type="submit" class="btn mt-5 float-right">
                        Laporkan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
