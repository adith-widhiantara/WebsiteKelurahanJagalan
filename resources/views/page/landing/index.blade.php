@extends('base.base')

@section('title')
@guest
Selamat Datang
@else
{{ Auth::user()->nama }}
@endguest
@endsection

@section('base')
<!-- slider Area-->
@include('page.landing.part.sliderArea')
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
