@extends('base.admin')

@section('title')
{{ __('Surat ').$dataSurat->user->nama }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.surat.show', $dataSurat) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Detail Surat Warga
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>
                        Nama Pengusul
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor KTP
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->nomor_ktp }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor Kartu Keluarga
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->anggota->kartu->nomorkk }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Tempat, Tanggal Lahir
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->anggota->tempat_lahir.__(', ').\Carbon\Carbon::parse($dataSurat->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y') }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Sedang Mengajukan Surat
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->jenis->nama_surat }}" disabled>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.kartukeluarga.anggota.show', ['kartuKeluarga' => $dataSurat->user->anggota->kartu->nomorkk, 'anggotaKeluarga' => $dataSurat->user->nomor_ktp]) }}" class="btn btn-primary">
                        Lihat Biodata Warga
                    </a>
                </div>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $dataSurat->jenis->nama_surat }}
                </h3>
            </div>
            <div class="card-body">
                @if ($dataSurat->jenis->slug == 'surat_keterangan_usaha')
                <div class="form-group">
                    <label>
                        Pekerjaan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->anggota->pekerjaan->keterangan }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Bekerja Sejak Tahun
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->usaha->sejak }}" disabled>
                </div>
                @elseif ($dataSurat->jenis->slug == 'surat_keterangan_tidak_mampu')
                <div class="form-group">
                    <label>
                        Pekerjaan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->anggota->pekerjaan->keterangan }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nama Ayah
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->anggota->nama_ayah }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nama Ibu
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->user->anggota->nama_ibu }}" disabled>
                </div>
                @elseif ($dataSurat->jenis->slug == 'surat_keterangan_beda_nama')
                <div class="form-group">
                    <label>
                        Jenis Surat
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->bedaNama->jenis_surat }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nama Yang Tertera Pada Surat Tersebut
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->bedaNama->nama_yang_tertera }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Nomor Surat Tersebut
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->bedaNama->nomor_surat_tersebut }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        {{ __('Lihat Berkas ').$dataSurat->bedaNama->jenis_surat }}
                    </label>
                    <a href="{{ route('admin.surat.show.file', $dataSurat->id) }}" class="btn btn-success btn-block" target="_blank">
                        Lihat Berkas
                    </a>
                </div>
                @elseif ($dataSurat->jenis->slug == 'surat_keterangan_penghasilan')
                <div class="form-group">
                    <label>
                        Penghasilan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->getPenghasilan() }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        {{ __('Lihat Berkas Penghasilan') }}
                    </label>
                    <a href="{{ route('admin.surat.show.file', $dataSurat->id) }}" class="btn btn-success btn-block" target="_blank">
                        Lihat Berkas
                    </a>
                </div>
                @elseif ($dataSurat->jenis->slug == 'surat_keterangan_harga_tanah')
                <div class="form-group">
                    <label>
                        Nomor Sertifikat
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->nomor_sertifikat }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Atas Nama Sertifikat
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->atas_nama_sertifikat }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Luas Tanah
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->luas_tanah }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Batas Tanah Utara
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->batas_tanah_utara }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Batas Tanah Selatan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->batas_tanah_selatan }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Batas Tanah Timur
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->batas_tanah_timur }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Batas Tanah Barat
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->hargaTanah->batas_tanah_barat }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Harga Tafsiran Tanah
                    </label>
                    <input type="text" class="form-control" value="{{ number_format($dataSurat->hargaTanah->harga_tafsiran_tanah) }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Harga Tafsiran Bangunan Rumah
                    </label>
                    <input type="text" class="form-control" value="{{ number_format($dataSurat->hargaTanah->harga_tafsiran_bangunan) }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        {{ __('Lihat Berkas Harga Tanah') }}
                    </label>
                    <a href="{{ route('admin.surat.show.file', $dataSurat->id) }}" class="btn btn-success btn-block" target="_blank">
                        Lihat Berkas
                    </a>
                </div>
                @endif
                <div class="form-group">
                    <label>
                        Keperluan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->keperluan }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Pesan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->pesan }}" disabled>
                </div>

                <div class="form-group">
                    <label>
                        Keterangan
                    </label>
                    <input type="text" class="form-control" value="{{ $dataSurat->keterangan }}" disabled>
                </div>

                @isset($dataSurat -> ditolak)
                <div class="form-group">
                    <label>
                        Ditolak
                    </label>
                    <input type="text" class="form-control is-invalid" value="{{ $dataSurat->ditolak->komentar }}" disabled>
                </div>
                @endisset
            </div>
            <div class="card-footer">
                @if ($dataSurat -> status === 1)
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.surat.show.file.result', $dataSurat->id) }}" class="btn btn-success" target="_blank">
                        Lihat Hasil Surat
                    </a>
                </div>
                @elseif ($dataSurat -> status === 0)
                <div class="d-flex justify-content-end">
                    <div class="alert alert-danger" role="alert">
                        Pengajuan Surat Telah Ditolak
                    </div>
                </div>
                @elseif (!$dataSurat -> status)
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#decline-modal">
                        Tolak
                    </a>

                    <div class="modal fade" id="decline-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Komentar Surat Ditolak</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.surat.store.declineAdministrasi', $dataSurat->id) }}" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label>
                                                Komentar
                                            </label>
                                            <input type="text" class="form-control" name="komentar" placeholder="Mengapa surat ini ditolak?" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a class="btn btn-default" data-dismiss="modal">Batalkan</a>
                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('accept-surat').submit();">
                        Setuju
                    </a>
                    <form style="display: none" action="{{ route('admin.surat.store.acceptAdministrasi', $dataSurat->id) }}" method="post" id="accept-surat">
                        @csrf
                        @method('put')
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
