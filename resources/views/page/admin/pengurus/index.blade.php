@extends('base.admin')

@php
$title = 'Daftar Pengguna & Pengurus Website';
@endphp

@section('title')
{{ $title }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pengurus.index') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Data Kepala Kelurahan
                    </h3>
                    <a href="#" class="btn btn-xs btn-default text-dark" data-toggle="modal" data-target="#daftar-kepala-kelurahan-modal">
                        Ubah Data
                    </a>

                    <div class="modal fade" id="daftar-kepala-kelurahan-modal">
                        <div class="modal-dialog">
                            <div class="modal-content text-dark">
                                <div class="modal-header">
                                    <h4 class="modal-title">Daftarkan Kepala Kelurahan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.pengurus.kepalakelurahan.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>
                                                Nomor Kartu Keluarga
                                            </label>
                                            <select class="form-control select2" id="kartuKeluargaKepalaKelurahanId" name="kartu_keluarga_kepala_kelurahan_id" required>
                                                <option value="">...</option>
                                                @foreach ($dataKartuKeluarga as $keluarga)
                                                <option @if ( old('kartu_keluarga_kepala_kelurahan_id')==$keluarga->id ) selected="selected" @endif
                                                    value="{{ $keluarga->id }}">{{ $keluarga->nomorkk }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                Nama
                                            </label>
                                            <select class="form-control select2" id="anggotaKeluargaKepalaKelurahanId" name="user_id" required>
                                                <option value="" disabled selected>...</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a href="{{ route('admin.pengurus.kepalakelurahan.create.new') }}" class="btn btn-success">
                                            Tambah Kepala Kelurahan Diluar Warga Kelurahan
                                        </a>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>
                        Kepala Kelurahan
                    </label>
                    <div class="row">
                        <div class="col-10">
                            @isset($kepalaKelurahanUser)
                            <a href="#" class="btn btn-default btn-block">{{ $kepalaKelurahanUser -> nama }}</a>
                            @else
                            <input type="text" class="form-control" value="Belum Terdata" disabled>
                            @endisset
                        </div>
                        <div class="col-2">
                            <a href="#" class="btn btn-primary btn-block">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Daftar RT dan RW
                </h3>
            </div>
            <div class="card-body">
                <table id='RwAndRtTable' class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor KTP</th>
                            <th>Bagian</th>
                            <th>Terakhir kali masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($RwDanRtData as $key => $rw)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ isset($rw['nama']) ? $rw['nama']->nama : '' }}</td>
                            <td>{{ isset($rw['nama']) ? $rw['nama']->nomor_ktp : '' }}</td>
                            <td>{{ $rw['bagian'] }}</td>
                            <td>{{ isset($rw['nama'] -> pengurus -> terakhir_masuk_sistem) ? \Carbon\Carbon::parse($rw['nama']-> pengurus -> terakhir_masuk_sistem)->diffForHumans() : 'Belum Masuk' }}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#daftar-rt-rw-{{ $key }}-modal">
                                    Ubah
                                </a>

                                <a href="{{ route('admin.pengurus.dataRtRw.show', $rw['nama']->nomor_ktp) }}" class="btn btn-xs btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="daftar-rt-rw-{{ $key }}-modal">
                            <div class="modal-dialog">
                                <div class="modal-content text-dark">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Daftarkan {{ $rw['bagian'] }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @php
                                    if(isset($rw['nama'])) {
                                    $dataRtRw = $rw['nama']->id;
                                    } else {
                                    $dataRtRw = null;
                                    }
                                    @endphp
                                    <form action="{{ route('admin.pengurus.dataRtRw.store', $dataRtRw) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>
                                                    Nomor Kartu Keluarga
                                                </label>
                                                <select class="form-control select2" id="kartuKeluargaRtRw{{ $key }}Id" name="kartu_keluarga_rt_rw_{{ $key }}_id" required>
                                                    <option value="">...</option>
                                                    @foreach ($dataKartuKeluarga as $keluarga)
                                                    <option @if ( old('kartu_keluarga_rt_rw_{{ $key }}_id')==$keluarga->id ) selected="selected" @endif
                                                        value="{{ $keluarga->id }}">{{ $keluarga->nomorkk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>
                                                    Nama
                                                </label>
                                                <select class="form-control select2" id="anggotaKeluargaRtRw{{ $key }}Id" name="user_id" required>
                                                    <option value="" disabled selected>...</option>
                                                </select>
                                            </div>

                                            <input type="hidden" name="bagian_kerja" value="{{ $rw['bagian'] }}" required>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Daftar Pengurus Website</h3>
                    <a href="#" class="btn btn-default text-dark btn-xs" data-toggle="modal" data-target="#daftar-pengurus-modal">
                        Daftarkan Pengurus
                    </a>
                </div>

                <div class="modal fade" id="daftar-pengurus-modal">
                    <div class="modal-dialog">
                        <div class="modal-content text-dark">
                            <div class="modal-header">
                                <h4 class="modal-title">Daftarkan Pengurus Website</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.pengurus.pegawai.store') }}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>
                                            Nomor Kartu Keluarga
                                        </label>
                                        <select class="form-control select2" id="kartuKeluargaId" name="kartu_keluarga_id" required>
                                            <option value="">...</option>
                                            @foreach ($dataKartuKeluarga as $keluarga)
                                            <option @if ( old('kartu_keluarga_id')==$keluarga->id ) selected="selected" @endif
                                                value="{{ $keluarga->id }}">{{ $keluarga->nomorkk }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Nama
                                        </label>
                                        <select class="form-control select2" id="anggotaKeluargaId" name="user_id" required>
                                            <option value="" disabled selected>...</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            Bagian Kerja
                                        </label>
                                        <select class="form-control select2" name="bagian_kerja" required>
                                            <option value="" disabled selected>...</option>
                                            <option value="Petugas Kelurahan">Petugas Kelurahan</option>
                                            <option value="Petugas Pajak">Petugas Pajak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a href="{{ route('admin.pengurus.create') }}" class="btn btn-success">Tambah Pengurus Diluar Warga Kelurahan</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id='example1' class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor KTP</th>
                            <th>Bagian Kerja</th>
                            <th>Terakhir kali masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengurusUser as $pengurus)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $pengurus -> nama }}</td>
                            <td>{{ $pengurus -> nomor_ktp }}</td>
                            <td>{{ $pengurus -> pengurus -> bagian_kerja }}</td>
                            <td>{{ $pengurus -> pengurus -> terakhir_masuk_sistem ? \Carbon\Carbon::parse($pengurus -> pengurus -> terakhir_masuk_sistem)->diffForHumans() : 'Belum Masuk' }}</td>
                            <td>
                                <a href="{{ route('admin.pengurus.show.pegawai', $pengurus->nomor_ktp) }}" class="btn btn-xs btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Daftar Akun Warga Lupa Password</h3>
            </div>
            <div class="card-body">
                <table id='akunWargaLupaPassword' class='table table-bordered table-striped table-hover'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataLupaPassword as $lupaPass)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $lupaPass -> nama }}</td>
                            <td>{{ $lupaPass -> nomor_ktp }}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-warning" onclick="event.preventDefault(); document.getElementById('lupaPassword-{{ $lupaPass -> nomor_ktp }}').submit()">
                                    Reset Password
                                </a>

                                <form style="display: none" id="lupaPassword-{{ $lupaPass -> nomor_ktp }}" action="{{ route('admin.pengurus.lupaPassword.admin', $lupaPass -> nomor_ktp) }}" method="post">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function() {
        // table
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#RwAndRtTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#RwAndRtTable_wrapper .col-md-6:eq(0)');

        $("#akunWargaLupaPassword").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#akunWargaLupaPassword_wrapper .col-md-6:eq(0)');

        // Select2
        $('.select2').select2();

        // chained dropdown
        $('#kartuKeluargaId').on('change', function(){
            let id = $(this).val();
            $('#anggotaKeluargaId').empty();
            $('#anggotaKeluargaId').append('<option value="" disabled selected>Tunggu...</option>');
            $.ajax({
                type: 'GET',
                url: 'pengurus/anggotakeluargadropdown/' + id,
                success: function (response){
                    var response = JSON.parse(response);
                    $('#anggotaKeluargaId').empty();
                    $('#anggotaKeluargaId').append('<option value="" disabled selected>Pilih Nama</option>');
                    response.forEach(element => {
                        $('#anggotaKeluargaId').append(`<option value="${element['id']}">${element['nama']}</option>`);
                    });
                }
            });
        });

        $('#kartuKeluargaKepalaKelurahanId').on('change', function(){
            let id = $(this).val();
            $('#anggotaKeluargaKepalaKelurahanId').empty();
            $('#anggotaKeluargaKepalaKelurahanId').append('<option value="" disabled selected>Tunggu...</option>');
            $.ajax({
                type: 'GET',
                url: 'pengurus/anggotakeluargadropdown/' + id,
                success: function (response){
                    var response = JSON.parse(response);
                    $('#anggotaKeluargaKepalaKelurahanId').empty();
                    $('#anggotaKeluargaKepalaKelurahanId').append('<option value="" disabled selected>Pilih Nama</option>');
                    response.forEach(element => {
                        $('#anggotaKeluargaKepalaKelurahanId').append(`<option value="${element['id']}">${element['nama']}</option>`);
                    });
                }
            });
        });

        @foreach ($RwDanRtData as $key => $rw)
        $(`#kartuKeluargaRtRw{{ $key }}Id`).on('change', function(){
            let id = $(this).val();
            $('#anggotaKeluargaRtRw{{ $key }}Id').empty();
            $('#anggotaKeluargaRtRw{{ $key }}Id').append('<option value="" disabled selected>Tunggu...</option>');
            $.ajax({
                type: 'GET',
                url: 'pengurus/anggotakeluargadropdown/' + id,
                success: function (response){
                    var response = JSON.parse(response);
                    $('#anggotaKeluargaRtRw{{ $key }}Id').empty();
                    $('#anggotaKeluargaRtRw{{ $key }}Id').append('<option value="" disabled selected>Pilih Nama</option>');
                    response.forEach(element => {
                        $('#anggotaKeluargaRtRw{{ $key }}Id').append(`<option value="${element['id']}">${element['nama']}</option>`);
                    });
                }
            });
        });
        @endforeach
    });
</script>
@endsection
