@extends('base.admin')

@section('title')
{{ $userKeluarga->nama }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.kartukeluarga.anggota.show', $kartuKeluarga, $userKeluarga) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">
                    Detail Anggota Keluarga
                </h4>
            </div>
            <form action="{{ route('admin.kartukeluarga.anggota.update', ['kartuKeluarga' => $kartuKeluarga->nomorkk, 'anggotaKeluarga' => $userKeluarga->nomor_ktp]) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nama" name="nama" value="{{ $userKeluarga->nama }}" disabled>
                        <small class="form-text text-muted">Nama tidak bisa diganti.</small>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor KTP
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nomor KTP" name="nomor_ktp" value="{{ $userKeluarga->nomor_ktp }}" disabled>
                        <small class="form-text text-muted">Nomor KTP tidak bisa diganti.</small>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Telepon
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nomor Telepon" name="nomor_telepon" value="{{ $userKeluarga->nomor_telepon }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Gelar
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="gelar_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\Gelar::all() as $gelar )
                            <option @if( $userKeluarga->anggota->gelar_id == $gelar -> id ) selected="selected" @endif value="{{ $gelar -> id }}">{{ $gelar -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Jenis Kelamin
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="jenis_kelamin">
                            <option value="" selected="selected">...</option>
                            <option @if( $userKeluarga->anggota->jenis_kelamin=="Laki-Laki" ) selected="selected" @endif value="Laki-Laki">Laki-Laki</option>
                            <option @if( $userKeluarga->anggota->jenis_kelamin=="Perempuan" ) selected="selected" @endif value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Tempat Lahir
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" value="{{ $userKeluarga->anggota->tempat_lahir }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Tanggal Lahir
                        </label>
                        <div class="input-group date" id="tanggalLahir" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#tanggalLahir" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" required class="form-control datetimepicker-input" data-target="#tanggalLahir" name="tanggal_bulan_tahun_lahir" value="{{ $userKeluarga->anggota->tanggal_bulan_tahun_lahir }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Akte Kelahiran
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="surat_lahir">
                            <option value="" selected="selected">...</option>
                            <option @if( $userKeluarga->anggota->surat_lahir=="Ada" ) selected="selected" @endif value="Ada">Ada</option>
                            <option @if( $userKeluarga->anggota->surat_lahir=="Tidak Ada" ) selected="selected" @endif value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Akte Kelahiran
                        </label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor Akte Kelahiran, Apabila Ada" name="nomor_surat_lahir" value="{{ $userKeluarga->anggota->nomor_surat_lahir }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Golongan Darah
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="golongan_darah_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\GolonganDarah::all() as $darah )
                            <option @if( $userKeluarga->anggota->golongan_darah_id==$darah -> id ) selected="selected" @endif value="{{ $darah -> id }}">{{ $darah -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Agama
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="agama_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\Agama::all() as $agama )
                            <option @if( $userKeluarga->anggota->agama_id==$agama -> id ) selected="selected" @endif value="{{ $agama -> id }}">{{ $agama -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Kepercayaan Kepada Tuhan Yang Maha Esa
                        </label>
                        <input type="text" class="form-control" placeholder="Masukkan Kepercayaan Kepada Tuhan Yang Maha Esa, Apabila Memilih Kepercayaan Kepada Tuhan Yang Maha Esa" name="kepercayaan_terhadap_tuhan_yang_maha_esa" value="{{ $userKeluarga->anggota->kepercayaan_terhadap_tuhan_yang_maha_esa }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Status Perkawinan
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="status_perkawinan_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\StatusPerkawinan::all() as $kawin )
                            <option @if( $userKeluarga->anggota->status_perkawinan_id==$kawin -> id ) selected="selected" @endif value="{{ $kawin -> id }}">{{ $kawin -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Akte Perkawinan
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="buku_nikah">
                            <option value="" selected="selected">...</option>
                            <option @if( $userKeluarga->anggota->buku_nikah=="Ada" ) selected="selected" @endif value="Ada">Ada</option>
                            <option @if( $userKeluarga->anggota->buku_nikah=="Tidak Ada" ) selected="selected" @endif value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Akte Perkawinan
                        </label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor Akte Perkawinan, Apabila Ada" name="nomor_buku_nikah" value="{{ $userKeluarga->anggota->nomor_buku_nikah }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Tanggal Perkawinan
                        </label>
                        <div class="input-group date" id="tanggalPerkawinan" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#tanggalPerkawinan" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control datetimepicker-input" data-target="#tanggalPerkawinan" name="tanggal_perkawinan" value="{{ $userKeluarga->anggota->tanggal_perkawinan }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Akte Perceraian
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="surat_cerai">
                            <option value="" selected="selected">...</option>
                            <option @if( $userKeluarga->anggota->surat_cerai=="Ada" ) selected="selected" @endif value="Ada">Ada</option>
                            <option @if( $userKeluarga->anggota->surat_cerai=="Tidak Ada" ) selected="selected" @endif value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Akte Perceraian
                        </label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor Akte Perceraian, Apabila Ada" name="nomor_surat_cerai" value="{{ $userKeluarga->anggota->nomor_surat_cerai }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Tanggal Perceraian
                        </label>
                        <div class="input-group date" id="tanggalPerceraian" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#tanggalPerceraian" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control datetimepicker-input" data-target="#tanggalPerceraian" name="tanggal_perceraian" value="{{ $userKeluarga->anggota->tanggal_perceraian }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Status Hubungan Dengan Kepala Keluarga
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="status_hubungan_kepala_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\StatusHubunganKepala::all() as $keluarga )
                            <option @if( $userKeluarga->anggota->status_hubungan_kepala_id==$keluarga -> id ) selected="selected" @endif value="{{ $keluarga -> id }}">{{ $keluarga -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Kelainan Fisik dan Mental
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="kelainan_fisik">
                            <option value="" selected="selected">...</option>
                            <option @if( $userKeluarga->anggota->kelainan_fisik=="Ada" ) selected="selected" @endif value="Ada">Ada</option>
                            <option @if( $userKeluarga->anggota->kelainan_fisik=="Tidak Ada" ) selected="selected" @endif value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Penyandang Cacat
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="penyandang_cacat_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\PenyandangCacat::all() as $cacat )
                            <option @if( $userKeluarga->anggota->penyandang_cacat_id==$cacat -> id ) selected="selected" @endif value="{{ $cacat -> id }}">{{ $cacat -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Pendidikan Terakhir
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="pendidikan_terakhir_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\Pendidikan::all() as $pendidikan )
                            <option @if( $userKeluarga->anggota->pendidikan_terakhir_id==$pendidikan -> id ) selected="selected" @endif value="{{ $pendidikan -> id }}">{{ $pendidikan -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Pekerjaan
                        </label>
                        <select class="form-control select2" style="width: 100%;" name="pekerjaan_id">
                            <option value="" selected="selected">...</option>
                            @foreach ( \App\Models\KartuKeluarga\Pekerjaan::all() as $kerja )
                            <option @if( $userKeluarga->anggota->pekerjaan_id==$kerja -> id ) selected="selected" @endif value="{{ $kerja -> id }}">{{ $kerja -> keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            NIK Ibu
                        </label>
                        <input type="text" class="form-control" placeholder="Masukkan NIK Ibu" name="nik_ibu" value="{{ $userKeluarga->anggota->nik_ibu }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Nama Ibu
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nama Ibu" name="nama_ibu" value="{{ $userKeluarga->anggota->nama_ibu }}">
                    </div>

                    <div class="form-group">
                        <label>
                            NIK Ayah
                        </label>
                        <input type="text" class="form-control" placeholder="Masukkan NIK Ayah" name="nik_ayah" value="{{ $userKeluarga->anggota->nik_ayah }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Nama Ayah
                        </label>
                        <input type="text" required class="form-control" placeholder="Masukkan Nama Ayah" name="nama_ayah" value="{{ $userKeluarga->anggota->nama_ayah }}">
                    </div>

                    <div class="form-group">
                        <label>
                            Email
                        </label>
                        <input type="email" class="form-control" placeholder="Masukkan Email" name="email" value="{{ $userKeluarga->email }}">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.kartukeluarga.show', $kartuKeluarga -> nomorkk) }}" class="btn btn-warning">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
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

        $('#tanggalLahir').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        });

        $('#tanggalPerkawinan').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        });

        $('#tanggalPerceraian').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years'
        });
    });
</script>
@endsection
