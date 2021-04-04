@extends('base.admin')

@section('title')
Daftar Tabel Kartu Keluarga
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.tabelkartukeluarga.index') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        {{-- gelar --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Gelar</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-gelar-modal">
                    Tambah Gelar
                </a>

                <div class="modal fade" id="add-gelar-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Gelar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storeGelar') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Gelar</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama gelar" required>
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
            </div>
            <div class="card-body">
                <table id="gelarTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Gelar</th>
                            <th>Jumlah Yang Mempunyai Gelar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gelar as $gel)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $gel -> keterangan }}</td>
                            <td>{{ $gel -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-gelar-{{ $gel -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Gelar</th>
                            <th>Jumlah Yang Mempunyai Gelar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($gelar as $gel)
            <div class="modal fade" id="edit-gelar-{{ $gel -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Gelar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updateGelar', $gel -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Gelar</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $gel -> keterangan }}" placeholder="Masukkan nama gelar" required>
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
        {{-- end gelar --}}

        {{-- golongan darah --}}
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Golongan Darah</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-golongan-darah-modal">
                    Tambah Golongan Darah
                </a>

                <div class="modal fade" id="add-golongan-darah-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Golongan Darah</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storeGolonganDarah') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Golongan Darah</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan jenis golongan darah" required>
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
            </div>
            <div class="card-body">
                <table id="golonganDarahTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Golongan Darah</th>
                            <th>Jumlah Yang Mempunyai Jenis Golongan Darah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($golonganDarah as $darah)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $darah -> keterangan }}</td>
                            <td>{{ $darah -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-golongan-darah-{{ $darah -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Jenis Golongan Darah</th>
                            <th>Jumlah Yang Mempunyai Jenis Golongan Darah</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($golonganDarah as $darah)
            <div class="modal fade" id="edit-golongan-darah-{{ $darah -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Golongan Darah</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updateGolonganDarah', $darah -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Golongan Darah</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $darah -> keterangan }}" placeholder="Masukkan nama golongan darah" required>
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
        {{-- end golongan darah --}}

        {{-- agama --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Agama</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-agama-modal">
                    Tambah Agama
                </a>

                <div class="modal fade" id="add-agama-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Agama</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storeAgama') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Agama</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama agama" required>
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
            </div>
            <div class="card-body">
                <table id="agamaTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Agama</th>
                            <th>Jumlah Yang Mempunyai Agama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agama as $aga)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $aga -> keterangan }}</td>
                            <td>{{ $aga -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-agama-{{ $aga -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Agama</th>
                            <th>Jumlah Yang Mempunyai Agama</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($agama as $aga)
            <div class="modal fade" id="edit-agama-{{ $aga -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Agama</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updateAgama', $aga -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Agama</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $aga -> keterangan }}" placeholder="Masukkan nama agama" required>
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
        {{-- end agama --}}

        {{-- status perkawinan --}}
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Status Perkawinan</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-status-perkawinan-modal">
                    Tambah Status Perkawinan
                </a>

                <div class="modal fade" id="add-status-perkawinan-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Status Perkawinan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storeStatusPerkawinan') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Status Perkawinan</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama status perkawinan" required>
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
            </div>
            <div class="card-body">
                <table id="statusPerkawinanTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Status Perkawinan</th>
                            <th>Jumlah Yang Mempunyai Status Perkawinan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statusPerkawinan as $kawin)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $kawin -> keterangan }}</td>
                            <td>{{ $kawin -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-status-perkawinan-{{ $kawin -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Status Perkawinan</th>
                            <th>Jumlah Yang Mempunyai Status Perkawinan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($statusPerkawinan as $kawin)
            <div class="modal fade" id="edit-status-perkawinan-{{ $kawin -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Status Perkawinan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updateStatusPerkawinan', $kawin -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Status Perkawinan</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $kawin -> keterangan }}" placeholder="Masukkan nama status perkawinan" required>
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
        {{-- end status perkawinan --}}

        {{-- status hubungan dengan kepala keluarga --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Status Hubungan Dengan Kepala Keluarga</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-status-hubungan-dengan-kepala-keluarga-modal">
                    Tambah Status Hubungan Dengan Kepala Keluarga
                </a>

                <div class="modal fade" id="add-status-hubungan-dengan-kepala-keluarga-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Status Hubungan Dengan Kepala Keluarga</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storeStatusHubunganKepala') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Status Hubungan Dengan Kepala Keluarga</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama status hubungan dengan kepala keluarga" required>
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
            </div>
            <div class="card-body">
                <table id="statusHubunganKepalaTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Hubungan</th>
                            <th>Jumlah Hubungan Dengan Kepala Keluarga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statusHubunganKepala as $kepala)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $kepala -> keterangan }}</td>
                            <td>{{ $kepala -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-status-hubungan-kepala-{{ $kepala -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Hubungan</th>
                            <th>Jumlah Hubungan Dengan Kepala Keluarga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($statusHubunganKepala as $kepala)
            <div class="modal fade" id="edit-status-hubungan-kepala-{{ $kepala -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Status Hubungan Dengan Kepala Keluarga</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updateStatusHubunganKepala', $kepala -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Status Hubungan Dengan Kepala Keluarga</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $kepala -> keterangan }}" placeholder="Masukkan nama status hubungan dengan kepala keluarga" required>
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
        {{-- end status hubungan dengan kepala keluarga --}}

        {{-- penyandang cacat --}}
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Penyandang Cacat</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-penyandang-cacat-modal">
                    Tambah Penyandang Cacat
                </a>

                <div class="modal fade" id="add-penyandang-cacat-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Penyandang Cacat</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storePenyandangCacat') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Penyandang Cacat</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama penyandang cacat" required>
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
            </div>
            <div class="card-body">
                <table id="penyandangCacatTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyandang Cacat</th>
                            <th>Jumlah Penyandang Cacat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyandangCacat as $cacat)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $cacat -> keterangan }}</td>
                            <td>{{ $cacat -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-penyandang-cacat-{{ $cacat -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyandang Cacat</th>
                            <th>Jumlah Penyandang Cacat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($penyandangCacat as $cacat)
            <div class="modal fade" id="edit-penyandang-cacat-{{ $cacat -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Penyandang Cacat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updatePenyandangCacat', $cacat -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Penyandang Cacat</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $cacat -> keterangan }}" placeholder="Masukkan nama penyandang cacat" required>
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
        {{-- end penyandang cacat --}}

        {{-- pendidikan terakhir --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Pendidikan Terakhir</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-pendidikan-modal">
                    Tambah Pendidikan Terakhir
                </a>

                <div class="modal fade" id="add-pendidikan-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Pendidikan Terakhir</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storePendidikan') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Pendidikan Terakhir</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama pendidikan terakhir" required>
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
            </div>
            <div class="card-body">
                <table id="pendidikanTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pendidikan Terakhir</th>
                            <th>Jumlah Pendidikan Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendidikanTerakhir as $pendidikan)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $pendidikan -> keterangan }}</td>
                            <td>{{ $pendidikan -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-pendidikan-{{ $pendidikan -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Pendidikan Terakhir</th>
                            <th>Jumlah Pendidikan Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($pendidikanTerakhir as $pendidikan)
            <div class="modal fade" id="edit-pendidikan-{{ $pendidikan -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Pendidikan Terakhir</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updatePendidikan', $pendidikan -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $pendidikan -> keterangan }}" placeholder="Masukkan nama pendidikan terakhir" required>
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
        {{-- end pendidikan terakhir --}}

        {{-- pekerjaan --}}
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Pekerjaan</h3>
                <a href="#" class="btn btn-light btn-xs text-dark float-right" data-toggle="modal" data-target="#add-pekerjaan-modal">
                    Tambah Pekerjaan
                </a>

                <div class="modal fade" id="add-pekerjaan-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Tambah Pekerjaan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.tabelkartukeluarga.storePekerjaan') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="text-dark">Nama Pekerjaan</label>
                                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan nama pekerjaan" required>
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
            </div>
            <div class="card-body">
                <table id="pekerjaanTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pekerjaan</th>
                            <th>Jumlah Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pekerjaan as $kerja)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $kerja -> keterangan }}</td>
                            <td>{{ $kerja -> anggota -> count() }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-pekerjaan-{{ $kerja -> id }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Pekerjaan</th>
                            <th>Jumlah Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @foreach ($pekerjaan as $kerja)
            <div class="modal fade" id="edit-pekerjaan-{{ $kerja -> id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-dark">Edit Pekerjaan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.tabelkartukeluarga.updatePekerjaan', $kerja -> id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="text-dark">Nama Pekerjaan</label>
                                    <input type="text" class="form-control" name="keterangan" value="{{ $kerja -> keterangan }}" placeholder="Masukkan nama pekerjaan" required>
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
        {{-- end pekerjaan --}}
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
        // gelar
        $("#gelarTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#gelarTable_wrapper .col-md-6:eq(0)');
        // end gelar

        // golongan darah
        $("#golonganDarahTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#golonganDarahTable_wrapper .col-md-6:eq(0)');
        // end golongan darah

        // golongan darah
        $("#agamaTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#agamaTable_wrapper .col-md-6:eq(0)');
        // end golongan darah

        // status perkawinan
        $("#statusPerkawinanTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#statusPerkawinanTable_wrapper .col-md-6:eq(0)');
        // end status perkawinan

        // status hubungan dengan kepala keluarga
        $("#statusHubunganKepalaTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#statusHubunganKepalaTable_wrapper .col-md-6:eq(0)');
        // end status hubungan dengan kepala keluarga

        // penyandang cacat
        $("#penyandangCacatTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#penyandangCacatTable_wrapper .col-md-6:eq(0)');
        // end penyandang cacat

        // penyandang cacat
        $("#pendidikanTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#pendidikanTable_wrapper .col-md-6:eq(0)');
        // end penyandang cacat

        // pekerjaan
        $("#pekerjaanTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength" : 5,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#pekerjaanTable_wrapper .col-md-6:eq(0)');
        // end pekerjaan
    });
</script>
@endsection
