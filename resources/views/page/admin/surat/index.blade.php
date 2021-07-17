@extends('base.admin')

@php
$title = 'Daftar Seluruh Permintaan Surat Warga';
@endphp

@section('title')
{{ $title }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.surat.index') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        {{ $title }}
                    </h3>
                    <a href="#" class="btn btn-light btn-xs text-dark" data-toggle="modal" data-target="#modal-default">
                        Buat Surat Warga
                    </a>
                </div>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-dark">Pilih Surat</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    @foreach ($dataJenisSurat as $jenis)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-dark">
                                                {{ $jenis -> nama_surat }}
                                            </span>
                                            <a href="{{ route('admin.surat.create', $jenis->slug) }}" class="btn btn-primary btn-xs">
                                                Pilih
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
                            <th>Nama Pengusul</th>
                            <th>Nama Surat</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataSurat as $data)
                        <tr>
                            <td>{{ $loop -> iteration }}</td>
                            <td>{{ $data -> user -> nama }}</td>
                            <td>{{ $data -> jenis -> nama_surat }}</td>
                            <td>{{ $data -> keperluan }}</td>
                            <td>
                                @if ($data -> status === 1)
                                <span class="badge badge-pill badge-success">Diterima</span>
                                @elseif ($data -> status === 0)
                                <span class="badge badge-pill badge-danger">Ditolak</span>
                                @elseif (!$data -> status)
                                <span class="badge badge-pill badge-warning">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.surat.show', $data->id) }}" class="btn btn-primary btn-xs">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengusul</th>
                            <th>Nama Surat</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>

    {{-- set background aduan --}}
    <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header">
                Atur gambar latar belakang
            </div>
            <div class="card-body">
                <form action="{{ route('admin.surat.uploadImage') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputFile">Masukkan gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image" required>
                                <label class="custom-file-label" for="exampleInputFile">Pilih gambar</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Unggah</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">
                        Simpan
                    </button>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-bgimage">
                        Lihat gambar
                    </button>
                </div>

                <div class="modal fade" id="modal-bgimage">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Latar Belakang Aduan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php
                            $imageSurat = \App\Models\PengaturanWebsite::where('name', 'image_surat')->first()->description;
                            @endphp
                            <div class="modal-body">
                                <img src="{{ asset('storage/surat/bgimage/'.$imageSurat) }}" class="img-fluid">
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end set background aduan --}}
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

<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();

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
