@extends('base.base')

@php
$title = 'Daftar Pengajuan Surat Saya'
@endphp

@section('title')
{{ $title }}
@endsection

@section('base')
{{-- slider --}}
@include('page.aduan.part.slider', ['title' => $title])
{{-- end slider --}}

<div class="container-fluid my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @foreach ($dataSurat as $data)
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title">{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}</h5>
                    <p class="card-text">{{ $data->jenis->nama_surat }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Status :
                        @if ($data->status === 1)
                        <span class="badge badge-pill badge-success">Diterima</span>
                        @elseif ($data->status === 0)
                        <span class="badge badge-pill badge-danger">Ditolak</span>
                        @elseif (!$data->status)
                        <span class="badge badge-pill badge-warning">Menunggu</span>
                        @endif
                    </li>

                    @isset($data->ditolak)
                    <li class="list-group-item">Ditolak karena : {{ $data->ditolak->komentar }}</li>
                    @endisset

                    @isset($data->usaha)
                    <li class="list-group-item">Pekerjaan : {{ $data->user->anggota->pekerjaan->keterangan }}</li>
                    <li class="list-group-item">Bekerja Sejak Tahun : {{ $data->usaha->sejak }}</li>
                    @endisset

                    @if($data->jenis->slug == 'surat_keterangan_tidak_mampu')
                    <li class="list-group-item">Pekerjaan : {{ $data->user->anggota->pekerjaan->keterangan }}</li>
                    <li class="list-group-item">Nama Ayah : {{ $data->user->anggota->nama_ayah }}</li>
                    <li class="list-group-item">Nama Ibu : {{ $data->user->anggota->nama_ibu }}</li>
                    @endif

                    @isset($data->bedaNama)
                    <li class="list-group-item">Jenis Surat : {{ $data->bedaNama->jenis_surat }}</li>
                    <li class="list-group-item">Nama Yang Tertera Pada Surat Tersebut : {{ $data->bedaNama->nama_yang_tertera }}</li>
                    <li class="list-group-item">Nomor Surat Tersebut : {{ chunk_split($data->bedaNama->nomor_surat_tersebut, 4, ' ') }}</li>
                    @endisset

                    @isset($data->penghasilan)
                    <li class="list-group-item">Penghasilan : {{ $data->getPenghasilan() }}</li>
                    @endisset

                    <li class="list-group-item">Keperluan : {{ $data->keperluan }}</li>
                    <li class="list-group-item">Pesan : {{ $data->pesan }}</li>

                    @isset($data->keterangan)
                    <li class="list-group-item">Keterangan : {{ $data->keterangan }}</li>
                    @endisset

                    @if ($data->jenis->slug == 'surat_keterangan_beda_nama' || $data->jenis->slug == 'surat_keterangan_harga_tanah' || $data->jenis->slug == 'surat_keterangan_penghasilan')
                    <li class="list-group-item">
                        <a href="{{ route('warga.surat.show.file', $data->id) }}" class="genric-btn success-border small btn-block" target="_blank">
                            Lihat Berkas Saya
                        </a>
                    </li>
                    @endif

                    @if ($data->status === 1)
                    <li class="list-group-item">
                        <a href="{{ route('warga.surat.show.result', $data->id) }}" class="btn btn-block" target="_blank">
                            Lihat Surat Pengajuan Saya
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
