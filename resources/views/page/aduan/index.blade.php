@extends('base.base')

@php
$title = 'Aduan Saya';
@endphp

@section('title')
{{ $title }}
@endsection

@section('base')
{{-- slider --}}
@include('page.aduan.part.slider', ['title' => $title])
{{-- end slider --}}

<div class="container-fluid my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <a href="{{ route('aduan.create') }}" class="btn mb-5 float-right">
                <i class="fas fa-newspaper"></i>
                Buat Aduan
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

            @forelse ($aduan as $adu)
            <div class="card mb-5">
                <img src="{{ asset('image/aduan/'. $adu->foto->first()->foto) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $adu -> jenisAduan -> nama_aduan }}</h5>
                    <p class="card-text">{{ $adu -> judul_masalah }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        @if (isset($adu->nonValid))
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @elseif (isset($adu->valid))
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($adu -> progress / 5)*100 }}%" aria-valuenow="{{ ($adu -> progress / 5)*100 }}" aria-valuemin="0" aria-valuemax="100">
                                {{ ($adu -> progress / 5)*100 }}%
                            </div>
                        </div>
                        @endif
                    </li>
                    <li class="list-group-item">{{ $adu -> detail_pengaduan }}</li>
                    <li class="list-group-item">
                        @if (isset($adu->nonValid))
                        Mohon maaf aduan tidak valid
                        @elseif (isset($adu->valid))
                        Valid
                        @endif
                    </li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('aduan.show', $adu -> slug) }}" class="btn btn-block">Informasi selengkapnya</a>
                </div>
            </div>
            @empty
            <div class="card">
                <div class="row">
                    <div class="col-6 offset-3">
                        <img src="{{ asset('image/empty.png') }}" alt="empty.png" class="card-img-top">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Selamat datang, {{ Auth::user()->nama }}.</h5>
                    <p class="card-text">Aduan anda masih kosong, silakan buat aduan <a href="{{ route('aduan.create') }}" style="color: #000000">disini</a>, atau ketuk tombol "Buat Aduan" diatas.</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</div>
@endsection
