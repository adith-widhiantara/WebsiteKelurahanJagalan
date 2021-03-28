@extends('base.admin')

@section('title')
Daftar Aduan
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.aduan.index') }}
@endsection

@section('base')
<div class="row">
    {{-- Table daftar aduan masyarakat --}}
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
                            <td>{{ ($adu-> progress/5)*100 }}%</td>
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
                            <td>{{ \Carbon\Carbon::parse($adu-> created_at)->isoFormat('HH:mm dddd, D/M/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.aduan.show', $adu-> slug) }}" class="btn btn-primary btn-xs">
                                    Detail
                                </a>
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
    {{-- end Table daftar aduan masyarakat --}}

    {{-- grafik --}}
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Grafik Aduan Masyarakat</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="chart">
                            <canvas id="aduanGrafik1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="chart">
                            <canvas id="aduanGrafik2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end grafik --}}

    {{-- daftar kategori aduan --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Daftar Kategori Aduan
                <a href="#" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#add-category-aduan">
                    Tambah Kategori Aduan
                </a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Jumlah Aduan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisAduan as $jenis)
                        <tr>
                            <th scope="row">{{ $loop -> iteration }}</th>
                            <td>{{ $jenis -> nama_aduan }}</td>
                            <td>{{ $jenis -> keterangan }}</td>
                            <td>{{ $jenis -> aduan -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-category-{{ $jenis->id }}">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#show-category-{{ $jenis->id }}">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @foreach ($jenisAduan as $jenis)
            <div class="modal fade" id="show-category-{{ $jenis->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $jenis->nama_aduan }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered table-hover table-responsive">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Judul Masalah</th>
                                        <th>Penulis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenis->aduan as $aduan)
                                    <tr>
                                        <th scope="row">{{ $loop -> iteration }}</th>
                                        <td>{{ $aduan -> judul_masalah }}</td>
                                        <td>{{ $adu-> user -> nama }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-default right-float" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="card-footer">

            </div>
        </div>

        <div class="modal fade" id="add-category-aduan">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Kategori Aduan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('admin.aduan.storeJenisAduan') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Kategori Aduan</label>
                                <input type="text" class="form-control" placeholder="Nama Kategori Aduan" name="nama_aduan" required>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @foreach ($jenisAduan as $jenis)
        <div class="modal fade" id="edit-category-{{ $jenis->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Kategori Aduan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('admin.aduan.updateJenisAduan', $jenis -> slug) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Kategori Aduan</label>
                                <input type="text" class="form-control" placeholder="Nama Kategori Aduan" name="nama_aduan" required value="{{ $jenis -> nama_aduan }}">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" required value="{{ $jenis -> keterangan }}">
                            </div>
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

    </div>
    {{-- end daftar kategori aduan --}}
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

<script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>

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

        // BAR CHART
        var dataAduanCount1 = {
            labels  : [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            datasets: [
                {
                    label               : 'Aduan Selesai',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius         : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    @php
                    $dataSelesai = \App\Models\Aduan\Aduan::select('id', 'progress', 'created_at')
                        ->where('progress', 5)
                        ->get()
                        ->groupBy(function ($Selesai) {
                            return \Carbon\Carbon::parse($Selesai->created_at)->format('m');
                        });
                    @endphp
                    data                : [
                        @if (empty($dataSelesai['01'])) 0 @else {{ $dataSelesai['01']->count() }} @endif,
                        @if (empty($dataSelesai['02'])) 0 @else {{ $dataSelesai['02']->count() }} @endif,
                        @if (empty($dataSelesai['03'])) 0 @else {{ $dataSelesai['03']->count() }} @endif,
                        @if (empty($dataSelesai['04'])) 0 @else {{ $dataSelesai['04']->count() }} @endif,
                        @if (empty($dataSelesai['05'])) 0 @else {{ $dataSelesai['05']->count() }} @endif,
                        @if (empty($dataSelesai['06'])) 0 @else {{ $dataSelesai['06']->count() }} @endif,
                        @if (empty($dataSelesai['07'])) 0 @else {{ $dataSelesai['07']->count() }} @endif,
                        @if (empty($dataSelesai['08'])) 0 @else {{ $dataSelesai['08']->count() }} @endif,
                        @if (empty($dataSelesai['09'])) 0 @else {{ $dataSelesai['09']->count() }} @endif,
                        @if (empty($dataSelesai['10'])) 0 @else {{ $dataSelesai['10']->count() }} @endif,
                        @if (empty($dataSelesai['11'])) 0 @else {{ $dataSelesai['11']->count() }} @endif,
                        @if (empty($dataSelesai['12'])) 0 @else {{ $dataSelesai['12']->count() }} @endif,
                    ]
                },
                {
                    label               : 'Aduan Belum Dikonfirmasi',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    @php
                    $dataBelumSelesai = \App\Models\Aduan\Aduan::doesntHave('nonValid')
                        ->doesntHave('valid')
                        ->select('id', 'progress', 'created_at')
                        ->where('progress', '<', 90)
                        ->get()
                        ->groupBy(function ($val) {
                            return \Carbon\Carbon::parse($val->created_at)->format('m');
                    });
                    @endphp
                    data                : [
                        @if (empty($dataBelumSelesai['01'])) 0 @else {{ $dataBelumSelesai['01']->count() }} @endif,
                        @if (empty($dataBelumSelesai['02'])) 0 @else {{ $dataBelumSelesai['02']->count() }} @endif,
                        @if (empty($dataBelumSelesai['03'])) 0 @else {{ $dataBelumSelesai['03']->count() }} @endif,
                        @if (empty($dataBelumSelesai['04'])) 0 @else {{ $dataBelumSelesai['04']->count() }} @endif,
                        @if (empty($dataBelumSelesai['05'])) 0 @else {{ $dataBelumSelesai['05']->count() }} @endif,
                        @if (empty($dataBelumSelesai['06'])) 0 @else {{ $dataBelumSelesai['06']->count() }} @endif,
                        @if (empty($dataBelumSelesai['07'])) 0 @else {{ $dataBelumSelesai['07']->count() }} @endif,
                        @if (empty($dataBelumSelesai['08'])) 0 @else {{ $dataBelumSelesai['08']->count() }} @endif,
                        @if (empty($dataBelumSelesai['09'])) 0 @else {{ $dataBelumSelesai['09']->count() }} @endif,
                        @if (empty($dataBelumSelesai['10'])) 0 @else {{ $dataBelumSelesai['10']->count() }} @endif,
                        @if (empty($dataBelumSelesai['11'])) 0 @else {{ $dataBelumSelesai['11']->count() }} @endif,
                        @if (empty($dataBelumSelesai['12'])) 0 @else {{ $dataBelumSelesai['12']->count() }} @endif,
                    ]
                },
            ]
        }

        var barChartCanvas1 = $('#aduanGrafik1').get(0).getContext('2d')
        var barChartData1 = $.extend(true, {}, dataAduanCount1)
        var temp0 = dataAduanCount1.datasets[0]
        var temp1 = dataAduanCount1.datasets[1]
        barChartData1.datasets[0] = temp1
        barChartData1.datasets[1] = temp0

        var barChartOptions1 = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
        }

        var barChart1 = new Chart(barChartCanvas1, {
            type: 'bar',
            data: barChartData1,
            options: barChartOptions1
        })

        // bar chart 2
        var dataAduanCount2 = {
            labels  : [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ],
            datasets: [
                {
                    label               : 'Aduan Dikonfirmasi',
                    backgroundColor     : 'rgba(56,124,109,0.9)',
                    borderColor         : 'rgba(56,124,109,0.8)',
                    pointRadius         : false,
                    pointColor          : '#387c6d',
                    pointStrokeColor    : 'rgba(56,124,109,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(56,124,109,1)',
                    @php
                    $dataValid = \App\Models\Aduan\Aduan::has('valid')
                        ->select('id', 'progress', 'created_at')
                        ->where('progress', '<', 90)
                        ->get()
                        ->groupBy(function ($Selesai) {
                            return \Carbon\Carbon::parse($Selesai->created_at)->format('m');
                        });
                    @endphp
                    data                : [
                        @if (empty($dataValid['01'])) 0 @else {{ $dataValid['01']->count() }} @endif,
                        @if (empty($dataValid['02'])) 0 @else {{ $dataValid['02']->count() }} @endif,
                        @if (empty($dataValid['03'])) 0 @else {{ $dataValid['03']->count() }} @endif,
                        @if (empty($dataValid['04'])) 0 @else {{ $dataValid['04']->count() }} @endif,
                        @if (empty($dataValid['05'])) 0 @else {{ $dataValid['05']->count() }} @endif,
                        @if (empty($dataValid['06'])) 0 @else {{ $dataValid['06']->count() }} @endif,
                        @if (empty($dataValid['07'])) 0 @else {{ $dataValid['07']->count() }} @endif,
                        @if (empty($dataValid['08'])) 0 @else {{ $dataValid['08']->count() }} @endif,
                        @if (empty($dataValid['09'])) 0 @else {{ $dataValid['09']->count() }} @endif,
                        @if (empty($dataValid['10'])) 0 @else {{ $dataValid['10']->count() }} @endif,
                        @if (empty($dataValid['11'])) 0 @else {{ $dataValid['11']->count() }} @endif,
                        @if (empty($dataValid['12'])) 0 @else {{ $dataValid['12']->count() }} @endif,
                    ]
                },
                {
                    label               : 'Aduan Ditolak',
                    backgroundColor     : 'rgba(233, 137, 106, 1)',
                    borderColor         : 'rgba(233, 137, 106, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(233, 137, 106, 1)',
                    pointStrokeColor    : '#e9896a',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(233, 137, 106,1)',
                    @php
                    $dataNonValid = \App\Models\Aduan\Aduan::has('nonValid')
                        ->select('id', 'progress', 'created_at')
                        ->where('progress', '<', 90)
                        ->get()
                        ->groupBy(function ($val) {
                            return \Carbon\Carbon::parse($val->created_at)->format('m');
                    });
                    @endphp
                    data                : [
                        @if (empty($dataNonValid['01'])) 0 @else {{ $dataNonValid['01']->count() }} @endif,
                        @if (empty($dataNonValid['02'])) 0 @else {{ $dataNonValid['02']->count() }} @endif,
                        @if (empty($dataNonValid['03'])) 0 @else {{ $dataNonValid['03']->count() }} @endif,
                        @if (empty($dataNonValid['04'])) 0 @else {{ $dataNonValid['04']->count() }} @endif,
                        @if (empty($dataNonValid['05'])) 0 @else {{ $dataNonValid['05']->count() }} @endif,
                        @if (empty($dataNonValid['06'])) 0 @else {{ $dataNonValid['06']->count() }} @endif,
                        @if (empty($dataNonValid['07'])) 0 @else {{ $dataNonValid['07']->count() }} @endif,
                        @if (empty($dataNonValid['08'])) 0 @else {{ $dataNonValid['08']->count() }} @endif,
                        @if (empty($dataNonValid['09'])) 0 @else {{ $dataNonValid['09']->count() }} @endif,
                        @if (empty($dataNonValid['10'])) 0 @else {{ $dataNonValid['10']->count() }} @endif,
                        @if (empty($dataNonValid['11'])) 0 @else {{ $dataNonValid['11']->count() }} @endif,
                        @if (empty($dataNonValid['12'])) 0 @else {{ $dataNonValid['12']->count() }} @endif,
                    ]
                },
            ]
        }

        var barChartCanvas2 = $('#aduanGrafik2').get(0).getContext('2d')
        var barChartData2 = $.extend(true, {}, dataAduanCount2)
        var temp2 = dataAduanCount2.datasets[0]
        var temp3 = dataAduanCount2.datasets[1]
        barChartData2.datasets[0] = temp3
        barChartData2.datasets[1] = temp2

        var barChartOptions2 = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
        }

        var barChart1 = new Chart(barChartCanvas2, {
            type: 'bar',
            data: barChartData2,
            options: barChartOptions2
        })
    });
</script>
@endsection
