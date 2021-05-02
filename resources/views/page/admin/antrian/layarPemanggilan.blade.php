@extends('page.admin.antrian.base')

@section('title')
Layar Pemanggilan
@endsection

@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('b86dd85b9690beb7a5b2', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('panggilAntrianChannel');
    channel.bind('panggilAntrian-event', function(data) {
        $('#lastCalledAntrianDiv').empty();
        $('#lastAntrianPetugasKelurahanDiv').empty();
        $('#lastAntrianPetugasPajakDiv').empty();
        $('#lastAntrianKepalaKelurahanDiv').empty();

        $('#lastCalledAntrianDiv').append(
            `
            <h5 class="text-center" style="font-size: 80px">
                `+data['data']['lastCalledAntrian']['jenis_antrian']['name']+`
            </h5>
            <h1 class="text-center" style="font-size: 180px">
                `+data['data']['lastCalledAntrian']['nomor_antrian']+`
            </h1>
            <h5 class="text-center" style="font-size: 80px">
                `+data['data']['lastCalledAntrian']['user']['nama']+`
            </h5>
            `
        );

        $('#lastAntrianPetugasKelurahanDiv').append(
            `
            <h5 class="text-center" style="font-size: 30px">
                `+data['data']['lastAntrianPetugasKelurahan']['jenis_antrian']['name']+`
            </h5>
            <h1 class="text-center" style="font-size: 80px">
                `+data['data']['lastAntrianPetugasKelurahan']['nomor_antrian']+`
            </h1>
            <h5 class="text-center" style="font-size: 30px">
                `+data['data']['lastAntrianPetugasKelurahan']['user']['nama']+`
            </h5>
            `
        );

        $('#lastAntrianPetugasPajakDiv').append(
            `
            <h5 class="text-center" style="font-size: 30px">
                `+data['data']['lastAntrianPetugasPajak']['jenis_antrian']['name']+`
            </h5>
            <h1 class="text-center" style="font-size: 80px">
                `+data['data']['lastAntrianPetugasPajak']['nomor_antrian']+`
            </h1>
            <h5 class="text-center" style="font-size: 30px">
                `+data['data']['lastAntrianPetugasPajak']['user']['nama']+`
            </h5>
            `
        );

        $('#lastAntrianKepalaKelurahanDiv').append(
            `
            <h5 class="text-center" style="font-size: 30px">
                `+data['data']['lastAntrianKepalaKelurahan']['jenis_antrian']['name']+`
            </h5>
            <h1 class="text-center" style="font-size: 80px">
                `+data['data']['lastAntrianKepalaKelurahan']['nomor_antrian']+`
            </h1>
            <h5 class="text-center" style="font-size: 30px">
                `+data['data']['lastAntrianKepalaKelurahan']['user']['nama']+`
            </h5>
            `
        );
    });
</script>
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
                    <div class="col-12 mt-3 border-bottom" id="lastAntrianPetugasKelurahanDiv">
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
                    <div class="col-12 mt-3 border-bottom" id="lastAntrianPetugasPajakDiv">
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
                    <div class="col-12 mt-3 border-bottom" id="lastAntrianKepalaKelurahanDiv">
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
                        <div id="lastCalledAntrianDiv">
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
</div>
@endsection
