@extends('base.base')

@php
$title = 'Konten Tidak Ditemukan';
@endphp

@section('title')
{{ $title }}
@endsection

@section('base')
<div class="services-area section-padding41">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-60 text-center">
                    <h2>
                        {{ $title }}
                    </h2>
                </div>
                <div class="mb-5" style="display: flex; align-items: center; justify-content: center;">
                    <a href="{{ url()->previous() }}" class="btn">
                        <i class="fas fa-newspaper"></i>
                        Kembali Ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection