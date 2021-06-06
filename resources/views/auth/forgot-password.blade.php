@extends('base.base')

@php
$title = "Lupa Password";
@endphp

@section('title')
{{ $title }}
@endsection

@section('base')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(assets/img/hero/hero2.png);">
                <span class="login100-form-title-1">
                    {{ $title }}
                </span>
            </div>

            <div class="container my-4">
                <div class="alert alert-warning text-center" role="alert">
                    Alangkah baiknya, apabila anda menghubungi petugas kelurahan terlebih dahulu, setelah itu anda mengisi form dibawah.
                </div>
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
                @endforeach
                @endif
            </div>


            <form class="login100-form validate-form" method="POST">
                @csrf
                <div class="wrap-input100 validate-input m-b-26" data-validate="Harap Masukkan Nomor KTP">
                    <span class="label-input100">Nomor KTP</span>
                    <input class="input100" type="text" name="nomor_ktp" placeholder="Masukkan Nomor KTP" value="{{ old('nomor_ktp') }}" required autofocus autocomplete="off">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Lupa Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
