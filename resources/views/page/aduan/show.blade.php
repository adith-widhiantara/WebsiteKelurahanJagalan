@extends('base.base')

@php
$title = $aduan -> judul_masalah;
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
            <div class="card">
                <div class="card-header">
                    {{ $aduan -> jenisAduan -> nama_aduan }}
                </div>
                <div class="card-body">
                    {{ $aduan -> detail_pengaduan }}
                </div>
                <div class="card-body">
                    Anda membuat aduan ini pada {{ \Carbon\Carbon::parse($aduan -> created_at)->isoFormat('dddd, D/M/Y') }} pukul {{ \Carbon\Carbon::parse($aduan->created_at)->isoFormat('HH:mm') }}
                </div>
                <div class="card-footer">
                    Foto keterangan :
                    <div class="row gal lery-item">
                        @foreach ($aduan->foto as $foto)
                        <div class="col-md-4">
                            <a href="{{ asset('image/aduan/'.$foto->foto) }}" class="img-pop-up">
                                <div class="single-gallery-image">
                                    <img src="{{ asset('image/aduan/'.$foto->foto) }}" alt="" style="width: 100%; height: 150px; object-fit: cover">
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-lg-8 offset-lg-2">
            @isset($aduan -> nonValid)
            <div class="card">
                <div class="card-header">
                    {{ __('Aduan anda telah ditolak oleh ').\App\Models\User::where('id', $aduan -> nonValid -> comment -> user_id)->firstOrFail()->nama }}
                </div>
                <div class="card-body">
                    Keterangan :
                    {{ $aduan -> nonValid -> comment -> comment }}
                </div>
                <div class="card-footer">
                    <div class="row gal lery-item">
                        @foreach ($aduan -> nonValid -> foto as $foto)
                        <div class="col-md-4">
                            <a href="{{ asset('image/aduan/nonValid/'.$foto->photo) }}" class="img-pop-up">
                                <div class="single-gallery-image">
                                    <img src="{{ asset('image/aduan/nonValid/'.$foto->photo) }}" alt="" style="width: 100%; height: 150px; object-fit: cover">
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endisset

            @isset($aduan->valid)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Progress Aduan Anda : {{ ($aduan -> progress / 5)*100 }}%</h5>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($aduan -> progress / 5)*100 }}%" aria-valuenow="{{ ($aduan -> progress / 5)*100 }}" aria-valuemin="0" aria-valuemax="100">
                            {{ ($aduan -> progress / 5)*100 }}%
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Aduan Anda Valid</h2>
                </div>
            </div>

            @isset( $aduan -> valid -> commentKepala )
            <div class="card my-5">
                <div class="card-header">
                    Komentar Kepala Kelurahan
                </div>
                <div class="card-body">
                    <div class="mt-10">
                        <textarea class="single-textarea" disabled>{{ $aduan -> valid -> commentKepala -> comment }}</textarea>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
            @endisset

            @if ( $aduan -> valid -> commentRW -> status >= 2 )
            <div class="card my-5">
                @empty( $aduan -> valid -> commentWarga )
                <div class="card-header">
                    Diharapkan untuk menulis testimoni terkait aduan anda
                </div>
                <form action="{{ route('aduan.comment', $aduan->slug) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mt-10">
                            <textarea class="single-textarea" placeholder="Tulis komentar anda disini" name="comment" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block">
                            Simpan
                        </button>
                    </div>
                </form>
                @else
                <div class="card-header">
                    Komentar anda
                </div>
                <div class="card-body">
                    <div class="mt-10">
                        <textarea class="single-textarea" disabled>{{ $aduan -> valid -> commentWarga -> comment }}</textarea>
                    </div>
                </div>
                <div class="card-footer">

                </div>
                @endempty
            </div>

            <div class="card my-5">
                <div class="card-header">
                    Aduan anda telah selesai diatasi pada pukul {{ \Carbon\Carbon::parse($aduan -> valid -> commentRW -> updated_at)->isoFormat('HH:mm dddd, D/M/Y') }} oleh {{ \App\Models\User::where('id', $aduan -> valid -> commentRW -> user_id)->first()->nama }}
                </div>
                <div class="card-body">
                    Berikut adalah dokumentasi penindaklanjutan
                    <div class="row">
                        @foreach ($aduan -> valid -> foto as $foto)
                        <div class="col-md-4">
                            <a href="{{ asset('image/aduan/valid/'.$foto->foto) }}" class="img-pop-up">
                                <div class="single-gallery-image">
                                    <img src="{{ asset('image/aduan/valid/'.$foto->foto) }}" alt="" style="width: 100%; height: 150px; object-fit: cover">
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if ( $aduan -> valid -> commentRW -> status >= 1 )
            <div class="card my-5">
                <div class="card-header">
                    Aduan anda ditindaklanjut sejak pukul {{ \Carbon\Carbon::parse($aduan -> valid -> commentRW -> applied_at)->isoFormat('HH:mm dddd, D/M/Y') }} oleh {{ \App\Models\User::where('id', $aduan -> valid -> commentRW -> user_id)->first()->nama }}
                </div>
                <div class="card-body">
                    Aduan ini telah diterima, dan segera ditindaklanjut
                </div>
            </div>
            @endif

            <div class="card my-5">
                <div class="card-header">
                    Aduan anda divalidasi pada {{ \Carbon\Carbon::parse($aduan -> valid -> created_at)->isoFormat('HH:mm dddd, D/M/Y') }} oleh {{ \App\Models\User::where('id', $aduan -> valid -> user_id)->first()->nama }}
                </div>
                <div class="card-body">
                    Selanjutnya akan ditindaklanjut oleh RT/RW setempat
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
