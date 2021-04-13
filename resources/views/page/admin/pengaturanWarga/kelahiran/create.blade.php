@extends('base.admin')

@php
$title = 'Buat Data Kelahiran'
@endphp

@section('title')
{{ $title }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kelahiran.create', $kartuKeluarga) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $title }}
                </h3>
            </div>
            <form action="{{ route('admin.kelahiran.storeExists') }}" method="POST">
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
                                <a href="{{ route('admin.kelahiran.create.new', $kartuKeluarga -> nomorkk) }}" class="btn btn-primary btn-block">Tambah Anggota Keluarga Baru</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Nama Pelapor
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="nama_pelapor_id" required>
                            <option value="" selected="selected">...</option>
                            @foreach ( $kartuKeluarga -> anggota as $anggota )
                            <option @if( old('nama_pelapor_id')==$anggota -> user -> id ) selected="selected" @endif value="{{ $anggota -> user -> id }}">{{ $anggota -> user -> nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nomor Anak</label>
                        <input type="number" class="form-control" placeholder="Cth. 2" name="nomor_anak" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" placeholder="Cth. Keterangan" name="keterangan" required>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
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

<script>
    $(function(){
        $('.select2').select2();
    });
</script>
@endsection
