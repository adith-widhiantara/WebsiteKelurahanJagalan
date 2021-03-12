@extends('base.base')

@section('title')
Selamat Datang
@endsection

@section('base')
<!-- slider Area-->
@include('page.landing.sliderArea')
<!-- end slider Area-->

{{-- news area --}}
@include('page.landing.news')
{{-- end news area --}}

{{-- service area --}}
@include('page.landing.service')
{{-- end service area --}}

{{-- count down area --}}
@include('page.landing.countDown')
{{-- end count down area --}}

{{-- achievement area --}}
@include('page.landing.achievement')
{{-- end achievement area --}}

{{-- question area --}}
@include('page.landing.question')
{{-- end question area --}}
@endsection