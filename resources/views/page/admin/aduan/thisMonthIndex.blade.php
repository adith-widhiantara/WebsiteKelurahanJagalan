@extends('base.admin')

@section('title')
Aduan Bulan Ini
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.aduan.thisMonthIndex') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Aduan Masyarakat</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul Masalah</th>
                            <th>Jenis Aduan</th>
                            <th>Penulis</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aduan as $adu)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $adu-> judul_masalah }}</td>
                            <td>{{ $adu-> jenisAduan -> nama_aduan }}</td>
                            <td>{{ $adu-> user -> nama }}</td>
                            <td>{{ $adu-> progress.__('%') }}</td>
                            <td>
                                @if ( $adu -> nonValid )
                                <span class="badge badge-danger">
                                    Ditolak
                                </span>
                                @elseif ( $adu -> valid )
                                <span class="badge badge-success">
                                    Valid
                                </span>
                                @else
                                <span class="badge badge-secondary">
                                    Belum Dikonfirmasi
                                </span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($adu-> created_at)->isoFormat('HH:mm dddd, D-M-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.aduan.show', $adu-> slug) }}" class="btn btn-primary btn-xs">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Judul Masalah</th>
                            <th>Jenis Aduan</th>
                            <th>Penulis</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
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
    });
</script>
@endsection
