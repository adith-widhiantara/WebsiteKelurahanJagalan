@extends('base.admin')

@section('title')
Profil Saya
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.pengurus.profilSaya') }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Profil Saya</h3>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <input type="text" class="form-control" value="{{ $user -> nama }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor KTP
                        </label>
                        <input type="text" class="form-control" value="{{ $user -> nomor_ktp }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>
                            Bagian Kerja
                        </label>
                        @if ($user->nomor_ktp == 'admin')
                        <input type="text" class="form-control" value="{{ __('Admin') }}" disabled>
                        @else
                        <input type="text" class="form-control" value="{{ $user -> pengurus -> bagian_kerja }}" disabled>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Telepon
                        </label>
                        <input type="text" class="form-control" value="{{ $user -> nomor_telepon }}" name="nomor_telepon">
                    </div>

                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="text" class="form-control" value="{{ $user -> email }}" name="email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Foto Profil</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                                <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Unggah</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Ganti Password
                        </label>
                        <input type="password" class="form-control" name="password" placeholder="Ketikkan password baru anda, apabila akan merubahnya">
                    </div>

                    @if ($user -> nomor_ktp != 'admin')
                    @isset($user -> pengurus -> alamat)
                    <div class="form-group">
                        <label>
                            Alamat
                        </label>
                        <input type="text" class="form-control" value="{{ $user -> pengurus -> alamat }}" name="alamat">
                    </div>
                    @else
                    <div class="form-group">
                        <label>
                            Alamat
                        </label>
                        <input type="text" class="form-control" value="{{ $user -> anggota -> kartu -> alamat }}" disabled>
                    </div>
                    @endisset
                    @endif
                </div>
                <div class="card-footer">
                    @isset($user -> anggota -> kartu )
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.kartukeluarga.show', $user -> anggota -> kartu -> nomorkk) }}" class="btn btn-success" target="_blank">
                            Buka Kartu Keluarga
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                    @else
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                    @endisset
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection
