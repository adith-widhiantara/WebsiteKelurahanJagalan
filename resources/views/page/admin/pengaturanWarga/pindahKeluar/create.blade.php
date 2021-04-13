@extends('base.admin')

@php
$title = 'Buat Data Pindah Keluar';
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
{{ Breadcrumbs::render('admin.pindahkeluar.create', $kartuKeluarga) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $title }}
                </h3>
            </div>
            <form action="{{ route('admin.pindahkeluar.store', $kartuKeluarga->nomorkk) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="user_id" required>
                            <option value="" selected="selected">...</option>
                            @foreach ( $user as $use )
                            <option @if( old('user_id')==$use -> id ) selected="selected" @endif value="{{ $use -> id }}">{{ $use -> nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Alamat Asal
                        </label>
                        <input type="text" class="form-control" value="{{ $kartuKeluarga -> alamat }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>
                            Alamat Tujuan
                        </label>
                        <input type="text" class="form-control" name="alamat_tujuan" placeholder="Cth. Alamat Tujuan" required>
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
                        <label>
                            Nomor Surat
                        </label>
                        <input type="text" class="form-control" name="nomor_surat" placeholder="Cth. Nomor Surat" required>
                    </div>

                    <div class="form-group">
                        <label for="input-berkas-pindah-keluar">Berkas Surat Pindah Keluar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="input-berkas-pindah-keluar" name="file_surat">
                                <label class="custom-file-label" for="input-berkas-pindah-keluar">Pilih Berkas</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Unggah</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Keterangan
                        </label>
                        <input type="text" class="form-control" name="keterangan" placeholder="Cth. Keterangan" required>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">
                            Kembali
                        </a>
                        <button class="btn btn-success" type="submit">
                            Simpan
                        </button>
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
