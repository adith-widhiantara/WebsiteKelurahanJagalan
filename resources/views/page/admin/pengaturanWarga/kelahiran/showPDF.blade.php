<!doctype html>
<html lang="en">

<head>
    <title>{{ __('Cetak Data Kelahiran ').$dataKelahiran -> user -> nama }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


</head>

<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-3 border-right">
                <img src="{{ asset('image/assets/Logo-Kota-Kediri.png') }}" alt="Logo Kota Kediri" class="img-fluid">
            </div>
            <div class="col-9">
                <h1 class="text-center">Kelurahan Jagalan</h1>
                <h6 class="text-center">Kota Kediri</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Nama</p>
            </div>
            <div class="col-8">
                <p>{{ __(': ').$dataKelahiran -> user -> nama }}</p>
            </div>
        </div>
    </div>
</body>

</html>
