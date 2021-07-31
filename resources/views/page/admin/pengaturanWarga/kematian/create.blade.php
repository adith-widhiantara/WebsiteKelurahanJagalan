@extends('base.admin')

@section('title')
Buat Data Kematian
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kematian.create', $kartuKeluarga) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    Buat Data Kematian
                </h3>
            </div>
            <form action="{{ route('admin.kematian.store') }}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>
                            Nama Pelapor
                        </label>
                        <select class="form-control @if( session('error') ) is-invalid @endif select2" style="width: 100%;" name="nama_pelapor_id" required>
                            <option value="" selected="selected">...</option>
                            @foreach ( $user as $use )
                            <option @if( old('nama_pelapor_id')==$use -> id ) selected="selected" @endif value="{{ $use -> id }}">{{ $use -> nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Nama warga meninggal dengan nama pelapor sama!
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <select class="form-control @if( session('error') ) is-invalid @endif select2" style="width: 100%;" name="user_id" required>
                            <option value="" selected="selected">...</option>
                            @foreach ( $user as $use )
                            <option @if( old('user_id')==$use -> id ) selected="selected" @endif value="{{ $use -> id }}">{{ $use -> nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Nama warga meninggal dengan nama pelapor sama!
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Tanggal Meninggal
                        </label>
                        <div class="input-group date" id="tanggalMeninggal" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#tanggalMeninggal" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" required class="form-control datetimepicker-input" data-target="#tanggalMeninggal" name="tanggal_meninggal" value="{{ old('tanggal_meninggal') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Tempat Meninggal
                        </label>
                        <input type="text" class="form-control" name="tempat_meninggal" placeholder="Tulis Tempat Meninggal" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Sebab Meninggal
                        </label>
                        <input type="text" class="form-control" name="sebab_meninggal" placeholder="Tulis Sebab Meninggal" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Keterangan
                        </label>
                        <input type="text" class="form-control" name="keterangan" placeholder="Tulis Keterangan">
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
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

<script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(function(){
        $('.select2').select2();

        $('#tanggalMeninggal').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        });
    });
</script>
@endsection
