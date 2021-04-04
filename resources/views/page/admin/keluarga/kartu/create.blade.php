@extends('base.admin')

@section('title')
Buat Kartu Keluarga
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kartukeluarga.create') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    Buat Kartu Keluarga
                </h3>
            </div>
            <form action="{{ route('admin.kartukeluarga.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputNomorKK">Nomor Kartu Keluarga</label>
                        <input type="text" class="form-control" id="inputNomorKK" placeholder="Masukkan Nomor Kartu Keluarga" required name="nomorkk" value="{{ old('nomorkk') }}">
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <input type="text" class="form-control" id="inputAlamat" placeholder="Masukkan Alamat" required name="alamat" value="{{ old('alamat') }}">
                    </div>
                    <div class="form-group">
                        <label for="inputKodePos">Kode Pos</label>
                        <input type="number" class="form-control" id="inputKodePos" placeholder="Masukkan Kode Pos" required name="kode_pos" value="{{ old('kode_pos') }}">
                    </div>
                    <div class="form-group">
                        <label for="inputRT">RT</label>
                        <input type="number" class="form-control" id="inputRT" placeholder="Masukkan RT" required name="rt" value="{{ old('rt') }}">
                    </div>
                    <div class="form-group">
                        <label for="inputRW">RW</label>
                        <input type="number" class="form-control" id="inputRW" placeholder="Masukkan RW" required name="rw" value="{{ old('rw') }}">
                    </div>
                    <div class="form-group">
                        <label for="inputTeleponRumah">Telepon Rumah</label>
                        <input type="text" class="form-control" id="inputTeleponRumah" placeholder="Masukkan Telepon Rumah" required name="telepon_rumah" value="{{ old('telepon_rumah') }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
