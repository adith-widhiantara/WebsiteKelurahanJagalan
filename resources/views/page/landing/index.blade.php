@extends('base.base')

@section('title')
@guest
Selamat Datang
@else
{{ Auth::user()->nama }}
@endguest
@endsection

@php
$imageAduan = \App\Models\PengaturanWebsite::where('name', 'image_aduan')->first()->description;
$imageSurat = \App\Models\PengaturanWebsite::where('name', 'image_surat')->first()->description;
$imagePenghargaan = \App\Models\PengaturanWebsite::where('name', 'image_penghargaan')->first()->description;
$imageBantuan = \App\Models\PengaturanWebsite::where('name', 'image_bantuan')->first()->description;
@endphp

@section('base')
<!-- slider Area-->
@include('page.landing.part.sliderArea', ['imageAduan' => $imageAduan, 'imageSurat' => $imageSurat])
<!-- end slider Area-->

{{-- news area --}}
@include('page.landing.part.news')
{{-- end news area --}}

{{-- service area --}}
@include('page.landing.part.service')
{{-- end service area --}}

{{-- count down area --}}
@include('page.landing.part.countDown')
{{-- end count down area --}}

{{-- achievement area --}}
@include('page.landing.part.achievement')
{{-- end achievement area --}}

{{-- question area --}}
@include('page.landing.part.question')
{{-- end question area --}}
@endsection
