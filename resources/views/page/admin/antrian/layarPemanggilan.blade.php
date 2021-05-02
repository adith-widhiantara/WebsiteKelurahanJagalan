@extends('page.admin.antrian.base')

@section('title')
Layar Pemanggilan
@endsection

@section('base')
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="font-size: 40px">
            <img src="{{ asset('assets/img/favicon.ico') }}" alt="" height="60" class="d-inline-block align-text-top">
            Kelurahan Jagalan
        </a>
        <a class="navbar-brand float-end" href="#" style="font-size: 40px">
            Panggilan Antrian
        </a>
    </div>
</nav>

<div class="container-fluid my-2">
    <div class="row">
        <div class="col-4">
            <div class="shadow p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-12 mt-3 border-bottom">
                        <h5 class="text-center" style="font-size: 30px">
                            {{ $lastAntrianPetugasKelurahan ? $lastAntrianPetugasKelurahan -> jenisAntrian -> name : __('Petugas Kelurahan') }}
                        </h5>
                        <h1 class="text-center" style="font-size: 80px">
                            {{ $lastAntrianPetugasKelurahan ? $lastAntrianPetugasKelurahan -> nomor_antrian : __('-') }}
                        </h1>
                        <h5 class="text-center" style="font-size: 30px">
                            {{ $lastAntrianPetugasKelurahan ? $lastAntrianPetugasKelurahan -> user -> nama : __('-') }}
                        </h5>
                    </div>
                    <div class="col-12 mt-3 border-bottom">
                        <h5 class="text-center" style="font-size: 30px">
                            {{ $lastAntrianPetugasPajak ? $lastAntrianPetugasPajak -> jenisAntrian -> name : __('Petugas Pajak') }}
                        </h5>
                        <h1 class="text-center" style="font-size: 80px">
                            {{ $lastAntrianPetugasPajak ? $lastAntrianPetugasPajak -> nomor_antrian : __('-') }}
                        </h1>
                        <h5 class="text-center" style="font-size: 30px">
                            {{ $lastAntrianPetugasPajak ? $lastAntrianPetugasPajak -> user -> nama : __('-') }}
                        </h5>
                    </div>
                    <div class="col-12 mt-3 border-bottom">
                        <h5 class="text-center" style="font-size: 30px">
                            {{ $lastAntrianKepalaKelurahan ? $lastAntrianKepalaKelurahan-> jenisAntrian -> name : __('Kepala Kelurahan') }}
                        </h5>
                        <h1 class="text-center" style="font-size: 80px">
                            {{ $lastAntrianKepalaKelurahan ? $lastAntrianKepalaKelurahan-> nomor_antrian : __('-') }}
                        </h1>
                        <h5 class="text-center" style="font-size: 30px">
                            {{ $lastAntrianKepalaKelurahan ? $lastAntrianKepalaKelurahan-> user -> nama : __('-') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="shadow p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-12 mt-3">
                        <h5 class="text-center" style="font-size: 60px; color: #ff0000">
                            Panggilan Saat ini!
                        </h5>
                        <h5 class="text-center" style="font-size: 80px">
                            {{ $lastCalledAntrian ? $lastCalledAntrian -> jenisAntrian -> name : __('-') }}
                        </h5>
                        <h1 class="text-center" style="font-size: 180px">
                            {{ $lastCalledAntrian ? $lastCalledAntrian -> nomor_antrian : __('-') }}
                        </h1>
                        <h5 class="text-center" style="font-size: 80px">
                            {{ $lastCalledAntrian ? $lastCalledAntrian -> user -> nama : __('-') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
