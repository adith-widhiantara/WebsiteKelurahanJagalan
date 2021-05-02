@extends('base.admin')

@php
$title = 'Daftar antrian hari ini';
@endphp

@section('title')
{{ $title }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.antrian.index.today') }}
@endsection

@section('base')
<div class="row">
    <div class="col-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Antrian Petugas Kelurahan</h3>
            </div>
            <div class="card-body">
                <table id='example1' class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAntrianPetugasKelurahan as $dataPetugasKelurahan)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $dataPetugasKelurahan -> nomor_antrian }}</td>
                            <td>
                                @if ($loop->first)
                                @if ($dataPetugasKelurahan -> status == 0)
                                <a href="#" class="btn btn-xs btn-primary" onclick="event.preventDefault(); document.getElementById('formPetugasKelurahanTahap1').submit();">
                                    Terima
                                </a>

                                <form action="{{ route('admin.antrian.terima', $dataPetugasKelurahan->id) }}" style="display: none" method="POST" id="formPetugasKelurahanTahap1">
                                    @csrf
                                    @method('put')
                                </form>
                                @elseif ($dataPetugasKelurahan -> status == 1)
                                <a href="#" class="btn btn-xs btn-primary" onclick="event.preventDefault(); document.getElementById('formPetugasKelurahanTahap2').submit();">
                                    Selesai
                                </a>
                                <a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault(); document.getElementById('formPetugasKelurahanTahap3').submit();">
                                    Tidak ada orang
                                </a>

                                <form action="{{ route('admin.antrian.selesai', $dataPetugasKelurahan->id) }}" method="POST" style="display: none" id="formPetugasKelurahanTahap2">
                                    @csrf
                                    @method('put')
                                </form>
                                <form action="{{ route('admin.antrian.tidak.selesai', $dataPetugasKelurahan->id) }}" method="POST" style="display: none" id="formPetugasKelurahanTahap3">
                                    @csrf
                                    @method('put')
                                </form>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nomor Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Daftar Antrian Petugas Pajak</h3>
            </div>
            <div class="card-body">
                <table id='example1' class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAntrianPetugasPajak as $dataPetugasPajak)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $dataPetugasPajak -> nomor_antrian }}</td>
                            <td>
                                @if ($loop->first)
                                @if ($dataPetugasPajak -> status == 0)
                                <a href="#" class="btn btn-xs btn-primary" onclick="event.preventDefault(); document.getElementById('formPetugasPajakTahap1').submit();">
                                    Terima
                                </a>

                                <form action="{{ route('admin.antrian.terima', $dataPetugasPajak->id) }}" style="display: none" method="POST" id="formPetugasPajakTahap1">
                                    @csrf
                                    @method('put')
                                </form>
                                @elseif ($dataPetugasPajak -> status == 1)
                                <a href="#" class="btn btn-xs btn-primary" onclick="event.preventDefault(); document.getElementById('formPetugasPajakTahap2').submit();">
                                    Selesai
                                </a>
                                <a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault(); document.getElementById('formPetugasPajakTahap3').submit();">
                                    Tidak ada orang
                                </a>

                                <form action="{{ route('admin.antrian.selesai', $dataPetugasPajak->id) }}" method="POST" style="display: none" id="formPetugasPajakTahap2">
                                    @csrf
                                    @method('put')
                                </form>
                                <form action="{{ route('admin.antrian.tidak.selesai', $dataPetugasPajak->id) }}" method="POST" style="display: none" id="formPetugasPajakTahap3">
                                    @csrf
                                    @method('put')
                                </form>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nomor Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Antrian Kepala Kelurahan</h3>
            </div>
            <div class="card-body">
                <table id='example1' class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAntrianKepalaKelurahan as $dataKepalaKelurahan)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $dataKepalaKelurahan -> nomor_antrian }}</td>
                            <td>
                                @if ($loop->first)
                                @if ($dataKepalaKelurahan -> status == 0)
                                <a href="#" class="btn btn-xs btn-primary" onclick="event.preventDefault(); document.getElementById('formKepalaKelurahanTahap1').submit();">
                                    Terima
                                </a>

                                <form action="{{ route('admin.antrian.terima', $dataKepalaKelurahan->id) }}" style="display: none" method="POST" id="formKepalaKelurahanTahap1">
                                    @csrf
                                    @method('put')
                                </form>
                                @elseif ($dataKepalaKelurahan -> status == 1)
                                <a href="#" class="btn btn-xs btn-primary" onclick="event.preventDefault(); document.getElementById('formKepalaKelurahanTahap2').submit();">
                                    Selesai
                                </a>
                                <a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault(); document.getElementById('formKepalaKelurahanTahap3').submit();">
                                    Tidak ada orang
                                </a>

                                <form action="{{ route('admin.antrian.selesai', $dataKepalaKelurahan->id) }}" method="POST" style="display: none" id="formKepalaKelurahanTahap2">
                                    @csrf
                                    @method('put')
                                </form>
                                <form action="{{ route('admin.antrian.tidak.selesai', $dataKepalaKelurahan->id) }}" method="POST" style="display: none" id="formKepalaKelurahanTahap3">
                                    @csrf
                                    @method('put')
                                </form>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nomor Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
