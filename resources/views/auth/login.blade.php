@extends('base.base')

@php
$title = "Masuk";
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
                    @php
                    echo $title
                    @endphp
                </span>
            </div>

            @if ($errors->any())
            <div class="container my-4">
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
                @endforeach
            </div>
            @endif


            <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="wrap-input100 validate-input m-b-26" data-validate="Harap Masukkan Nomor KTP">
                    <span class="label-input100">Nomor KTP</span>
                    <input class="input100" type="text" name="nomor_ktp" placeholder="Masukkan Nomor KTP" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate="Masukkan password">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Masukkan password" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-30">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                        <label class="label-checkbox100" for="ckb1">
                            Ingat Saya
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Lupa Password?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection