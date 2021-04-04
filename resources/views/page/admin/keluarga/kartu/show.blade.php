@extends('base.admin')

@php
use App\Models\User;
@endphp

@section('title')
{{ $kartuKeluarga -> nomorkk }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kartukeluarga.show', $kartuKeluarga) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">
                    Detail Kartu Keluarga
                </h4>
            </div>
            <form action="{{ route('admin.kartukeluarga.update', $kartuKeluarga -> nomorkk) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        @if ($kartuKeluarga -> anggota() -> where('status_hubungan_kepala_id', 1) -> count() > 1)
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                Kepala keluarga pada kartu keluarga ini terdata 2 anggota, tolong segera untuk diganti salah satu anggota!
                            </div>
                        </div>
                        @elseif ($kartuKeluarga -> anggota() -> where('status_hubungan_kepala_id', 1) -> count() == 0)
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                Kepala keluarga pada kartu keluarga belum terdata, tolong segera untuk menambahkan salah satu anggota!
                            </div>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kepala Keluarga</label>
                                @php
                                if ($kartuKeluarga -> anggota() -> where('status_hubungan_kepala_id', 1) -> count() > 0) {
                                $getName = $kartuKeluarga -> anggota() -> where('status_hubungan_kepala_id', 1) -> firstOrFail()->user_id;
                                $namaKepala = User::where('id', $getName)->firstOrFail()->nama;
                                } else {
                                $namaKepala = '( Kosong )';
                                }
                                @endphp
                                <input type="text" class="form-control" value="{{ $namaKepala }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" value="{{ $kartuKeluarga -> alamat }}" name="alamat" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input type="number" min="1" class="form-control" value="{{ $kartuKeluarga -> kode_pos }}" name="kode_pos" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>RW</label>
                                <input type="number" min="1" class="form-control" value="{{ $kartuKeluarga -> rw }}" name="rw" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>RT</label>
                                <input type="number" min="1" class="form-control" value="{{ $kartuKeluarga -> rt }}" name="rt" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control" value="{{ $kartuKeluarga -> telepon_rumah }}" name="telepon_rumah" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Jumlah Keluarga</label>
                                <input type="text" class="form-control" value="{{ $kartuKeluarga -> anggota -> count() }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('admin.kartukeluarga.anggota.create', $kartuKeluarga -> nomorkk) }}" class="btn btn-success float-right">
                        Tambah Anggota Keluarga
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h6 class="card-title">
                    Anggota Keluarga
                </h6>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Umur</th>
                            <th>Status Dengan Kepala Rumah Tangga</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kartuKeluarga -> anggota as $anggota)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ User::find($anggota -> user_id)->nama }}</td>
                            <td>{{ User::find($anggota -> user_id)->nomor_ktp }}</td>
                            <td>{{ \Carbon\Carbon::parse($anggota -> tanggal_bulan_tahun_lahir)->age.__(' tahun') }}</td>
                            <td>{{ $anggota -> status_hubungan -> keterangan }}</td>
                            <td>
                                <a href="{{ route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $kartuKeluarga->nomorkk, 'anggotaKeluarga' => User::find($anggota -> user_id)->nomor_ktp]) }}" class="btn btn-success btn-xs">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Umur</th>
                            <th>Status Dengan Kepala Rumah Tangga</th>
                            <th>Detail</th>
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
