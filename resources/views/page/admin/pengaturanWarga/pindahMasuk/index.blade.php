@extends('base.admin')

@section('title')
Daftar Pindah Masuk
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pindahmasuk.index') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Daftar Pindah Masuk Warga
                    </h3>
                    <a href="#" class="btn btn-default btn-xs text-dark" data-toggle="modal" data-target="#add-data-pindah-masuk">
                        Tambah Data Pindah Masuk
                    </a>

                    <div class="modal fade" id="add-data-pindah-masuk">
                        <div class="modal-dialog">
                            <div class="modal-content text-dark">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pilih Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <table id='add-table-data-pindah-masuk' class='table table-bordered table-striped table-hover'>
                                            <thead>
                                                <tr>
                                                    <th>Nomor KK</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataKartuKeluarga as $data)
                                                <tr>
                                                    <td>{{ $data -> nomorkk }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.pindahmasuk.create', $data -> nomorkk) }}" class="btn btn-primary btn-xs">
                                                            Pilih
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-end">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Tutup
                                    </button>
                                </div>
                            </div>
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
                            <th>Nomor KK</th>
                            <th>Alamat Asal</th>
                            <th>Nomor Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPindahMasuk as $data)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $data -> user -> nama }}</td>
                            <td>{{ $data -> user -> anggota -> kartu -> nomorkk }}</td>
                            <td>{{ $data -> alamat_asal }}</td>
                            <td>{{ $data -> nomor_surat }}</td>
                            <td><a href="{{ route('admin.pindahmasuk.show', $data -> id) }}" class="btn btn-xs btn-primary">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor KK</th>
                            <th>Alamat Asal</th>
                            <th>Nomor Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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

<script>
    $(function() {
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

        $("#add-table-data-pindah-masuk").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 3,
            "language": {
               "zeroRecords": "Data Tidak Ditemukan!",
            },
        }).buttons().container().appendTo('#add-table-data-kelahiran_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
