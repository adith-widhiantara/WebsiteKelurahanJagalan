@extends('base.admin')

@section('title')
Daftarkan Pengurus Website Kelurahan
@endsection

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pengurus.create') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftarkan Pengurus Website Kelurahan Diluar Warga Kelurahan</h3>
            </div>
            <form action="{{ route('admin.pengurus.store.new') }}" method="post">
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
                        <input type="text" required class="form-control" placeholder="Masukkan Nama" name="nama" value="{{ old('nama') }}">
                        <small class="form-text text-muted">Nama tidak bisa diganti.</small>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor KTP
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nomor KTP" name="nomor_ktp" value="{{ old('nomor_ktp') }}">
                        <small class="form-text text-muted">Nomor KTP tidak bisa diganti.</small>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Telepon
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nomor Telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Alamat
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Alamat" name="alamat" value="{{ old('alamat') }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="email" class="form-control" placeholder="Masukkan Email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Bagian Kerja
                        </label>
                        <select class="form-control select2" name="bagian_kerja" required>
                            <option value="" disabled selected>...</option>
                            <option value="Petugas Kelurahan">Petugas Kelurahan</option>
                            <option value="Petugas Pajak">Petugas Pajak</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function() {
        // Select2
        $('.select2').select2();
    });
</script>
@endsection
