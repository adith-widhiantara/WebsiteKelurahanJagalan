@extends('base.admin')

@php
$title = 'Buat Data Pindah Masuk';
@endphp

@section('title')
{{ $title }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pindahmasuk.create', $kartuKeluarga) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $title }}
                </h3>
            </div>
            <form action="{{ route('admin.pindahmasuk.store', $kartuKeluarga->nomorkk) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>
                            <i class="icon fas fa-ban"></i>
                            Ada Data Yang Keliru!
                        </h5>
                        <ol>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                    @endif

                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <div class="row">
                            <div class="col-8">
                                <select class="form-control select2" style="width: 100%;" name="user_id" required>
                                    <option value="" selected="selected">...</option>
                                    @foreach ( $user as $use )
                                    <option @if( old('user_id')==$use -> id ) selected="selected" @endif value="{{ $use -> id }}">{{ $use -> nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.pindahmasuk.create.new', $kartuKeluarga -> nomorkk) }}" class="btn btn-info btn-block">Tambah Anggota Keluarga Baru</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat Asal</label>
                        <input type="text" class="form-control" placeholder="Cth. Alamat Asal" name="alamat_asal" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Tanggal Surat
                        </label>
                        <div class="input-group date" id="tanggalSurat" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#tanggalSurat" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" required class="form-control datetimepicker-input" data-target="#tanggalSurat" name="tanggal_surat" value="{{ old('tanggal_surat') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" class="form-control" placeholder="Cth. Nomor Surat" name="nomor_surat" required>
                    </div>

                    <div class="form-group">
                        <label for="input-berkas-pindah-masuk">Berkas Surat Pindah Masuk</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="input-berkas-pindah-masuk" name="file_surat" required>
                                <label class="custom-file-label" for="input-berkas-pindah-masuk">Pilih Berkas</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" placeholder="Cth. Keterangan" name="keterangan">
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(function(){
        $('.select2').select2();

        bsCustomFileInput.init();

        $('#tanggalSurat').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        });
    });
</script>
@endsection
