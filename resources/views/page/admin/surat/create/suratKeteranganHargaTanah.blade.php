@extends('base.admin')

@php
$title = 'Buat Surat Warga';
@endphp

@section('title')
{{ $title }}
@endsection

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.surat.create', $dataJenisSurat) }}
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
            <form action="{{ route('admin.surat.store', $dataJenisSurat->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Jenis Surat
                        </label>
                        <input type="text" class="form-control" value="{{ $dataJenisSurat->nama_surat }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Kartu Keluarga
                        </label>
                        <select class="form-control select2" id="kartuKeluargaId" name="kartu_keluarga_id" required>
                            <option value="">...</option>
                            @foreach ($dataKartuKeluarga as $keluarga)
                            <option @if ( old('kartu_keluarga_id')==$keluarga->id ) selected="selected" @endif
                                value="{{ $keluarga->id }}">{{ $keluarga->nomorkk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Anggota Keluarga
                        </label>
                        <select class="form-control select2" id="anggotaKeluargaId" name="user_id" required>
                            <option value="" disabled selected>...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Nomor Sertifikat
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Nomor Sertifikat" name="nomor_sertifikat" value="{{ old('nomor_sertifikat') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Atas Nama Sertifikat
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Atas Nama Sertifikat" name="atas_nama_sertifikat" value="{{ old('atas_nama_sertifikat') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Luas Tanah
                        </label>
                        <input type="number" class="form-control" placeholder="Cth. 20 M?? (Cukup tulikan angkanya saja, dengan satuan M??)" name="luas_tanah" value="{{ old('luas_tanah') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Batas Tanah Sebelah Utara
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Batas Tanah Sebelah Utara" name="batas_tanah_utara" value="{{ old('batas_tanah_utara') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Batas Tanah Sebelah Selatan
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Batas Tanah Sebelah Selatan" name="batas_tanah_selatan" value="{{ old('batas_tanah_selatan') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Batas Tanah Sebelah Timur
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Batas Tanah Sebelah Timur" name="batas_tanah_timur" value="{{ old('batas_tanah_timur') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Batas Tanah Sebelah Barat
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Batas Tanah Sebelah Barat" name="batas_tanah_barat" value="{{ old('batas_tanah_barat') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Harga Tafsiran Tanah Saat Ini
                        </label>
                        <input type="number" class="form-control" placeholder="Cth. Harga Tafsiran Tanah Saat Ini" name="harga_tafsiran_tanah" value="{{ old('harga_tafsiran_tanah') }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Harga Tafsiran Bangunan Rumah Saat Ini
                        </label>
                        <input type="number" class="form-control" placeholder="Cth. Harga Tafsiran Bangunan Rumah Saat Ini" name="harga_tafsiran_bangunan" value="{{ old('harga_tafsiran_bangunan') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="uploadFileSertifikat">Berkas Sertifikat Tanah</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadFileSertifikat" name="fileSertifikatTanah">
                                <label class="custom-file-label" for="uploadFileSertifikat">Pilih Berkas</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            Keperluan
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Keperluan" name="keperluan" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Pesan
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Pesan" name="pesan" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Keterangan
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Keterangan" name="keterangan">
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- Select2 -->
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function() {
        // Select2
        $('.select2').select2();

        // bs-custom-file-input
        bsCustomFileInput.init();

        // chained dropdown
        $('#kartuKeluargaId').on('change', function(){
            let id = $(this).val();
            $('#anggotaKeluargaId').empty();
            $('#anggotaKeluargaId').append('<option value="" disabled selected>Tunggu...</option>');
            $.ajax({
                type: 'GET',
                url: 'anggotakeluargadropdown/' + id,
                success: function (response){
                    var response = JSON.parse(response);
                    $('#anggotaKeluargaId').empty();
                    $('#anggotaKeluargaId').append('<option value="" disabled selected>Pilih Kartu Keluarga</option>');
                    response.forEach(element => {
                        $('#anggotaKeluargaId').append(`<option value="${element['id']}">${element['nama']}</option>`);
                    });
                }
            });
        });
    });
</script>
@endsection
