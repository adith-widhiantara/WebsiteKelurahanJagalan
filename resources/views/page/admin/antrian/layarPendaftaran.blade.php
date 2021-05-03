@extends('page.admin.antrian.base')

@section('title')
Layar Pendaftaran
@endsection

@section('head')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b86dd85b9690beb7a5b2', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('countAntrianChannel');
    channel.bind('countAntrian-event', function(data) {
        $('#antrianPetugasKelurahanCountSpan').empty();
        $('#antrianPetugasPajakCountSpan').empty();
        $('#antrianKepalaKelurahanCountSpan').empty();

        $('#antrianPetugasKelurahanCountSpan').append(data['countAntrianEvent']['antrianPetugasKelurahanCount']);
        $('#antrianPetugasPajakCountSpan').append(data['countAntrianEvent']['antrianPetugasPajakCount']);
        $('#antrianKepalaKelurahanCountSpan').append(data['countAntrianEvent']['antrianKepalaKelurahanCount']);
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
            Pendaftaran Antrian
        </a>
    </div>
</nav>

<div class="container my-5">
    @if (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('danger') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Petugas Kelurahan</h1>
                    <p class="card-text">Jumlah antrian : <span id="antrianPetugasKelurahanCountSpan">{{ $antrianPetugasKelurahanCount }}</span></p>
                </div>
                <div class="card-footer d-grid gap-2">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-daftar-petugas-kelurahan">
                        Daftar
                    </a>
                </div>
            </div>

            <div class="modal fade" id="modal-daftar-petugas-kelurahan" tabindex="-1" aria-labelledby="modal-daftar-petugas-kelurahan-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-daftar-petugas-kelurahan-label">Masukkan NIK pendaftar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.antrian.petugasKelurahan.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="input-NIK" class="form-label">Masukkan NIK</label>
                                    <input type="number" class="form-control" id="input-NIK" placeholder="Masukkan Nomor Induk Kependudukan Anda" name="nik" required>
                                    <div class="form-text">Masukkan NIK untuk mendaftar antrian kepada petugas kelurahan</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Petugas<br>Pajak</h1>
                    <p class="card-text">Jumlah antrian : <span id="antrianPetugasPajakCountSpan">{{ $antrianPetugasPajakCount }}</span></p>
                </div>
                <div class="card-footer d-grid gap-2">
                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-daftar-petugas-pajak">
                        Daftar
                    </a>
                </div>
            </div>

            <div class="modal fade" id="modal-daftar-petugas-pajak" tabindex="-1" aria-labelledby="modal-daftar-petugas-pajak-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-daftar-petugas-pajak-label">Masukkan NIK pendaftar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.antrian.petugasPajak.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="input-NIK" class="form-label">Masukkan NIK</label>
                                    <input type="number" class="form-control" id="input-NIK" placeholder="Masukkan Nomor Induk Kependudukan Anda" name="nik" required>
                                    <div class="form-text">Masukkan NIK untuk mendaftar antrian kepada petugas pajak</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center">Kepala<br>Kelurahan</h1>
                    <p class="card-text">Jumlah antrian : <span id="antrianKepalaKelurahanCountSpan">{{ $antrianKepalaKelurahanCount }}</span></p>
                </div>
                <div class="card-footer d-grid gap-2">
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-daftar-kepala-kelurahan">
                        Daftar
                    </a>
                </div>
            </div>

            <div class="modal fade" id="modal-daftar-kepala-kelurahan" tabindex="-1" aria-labelledby="modal-daftar-kepala-kelurahan-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-daftar-kepala-kelurahan-label">Masukkan NIK pendaftar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.antrian.kepalaKelurahan.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="input-NIK" class="form-label">Masukkan NIK</label>
                                    <input type="number" class="form-control" id="input-NIK" placeholder="Masukkan Nomor Induk Kependudukan Anda" name="nik" required>
                                    <div class="form-text">Masukkan NIK untuk mendaftar antrian kepada petugas pajak</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
