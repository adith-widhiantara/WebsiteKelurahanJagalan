@extends('base.admin')

@section('title')
{{ $aduan->judul_masalah }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.aduan.show', $aduan) }}
@endsection

@section('base')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-9">
                <h5 class="card-title">{{ $aduan -> judul_masalah }}</h5>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.aduan.timeline', $aduan->slug) }}" class="btn btn-secondary btn-xs float-right">Lihat Progress</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h6 class="card-subtitle mb-2 text-muted">{{ $aduan -> jenisAduan -> nama_aduan }}</h6>
        <p class="card-text">{{ $aduan -> detail_pengaduan }}</p>
        <div class="row">
            @if ( isset($aduan->nonValid) )
            <div class="col-12">
                <div class="card bg-danger">
                    <div class="card-header">
                        <h5 class="card-title">
                            Aduan Telah Ditolak
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ __('Ditolak Oleh ').\App\Models\User::where('id', $aduan->nonValid->comment->user_id)->firstOrFail()->nama }}
                        </p>
                    </div>
                </div>

            </div>
            @elseif ( isset($aduan->valid) )
            <div class="col-12">
                <div class="card bg-success">
                    <div class="card-header">
                        <h5 class="card-title">
                            Aduan Valid
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ __('Diterima oleh ').\App\Models\User::where('id', $aduan->valid->user_id)->firstOrFail()->nama }}
                        </p>
                    </div>
                </div>
            </div>
            @else {{-- isset($aduan->nonValid) || isset($aduan->valid) --}}
            <div class="col-6">
                <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-tolak">Tolak</a>
            </div>
            <div class="col-6">
                <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-tindak-lanjut">Tindak Lanjut</a>
            </div>
            @endif
        </div>

        @if ( empty($aduan->nonValid) && empty($aduan->valid) )
        <div class="modal fade" id="modal-tolak">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tolak Aduan Masyarakat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.aduan.tolak.store', $aduan -> slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Komentar Ditolak</label>
                                <input type="text" name="comment" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Foto Penolakan</label>
                                <input type="file" name="foto[]" class="form-control-file" multiple required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-tindak-lanjut">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tindak Lanjut Aduan Masyarakat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.aduan.valid.store', $aduan->slug) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <h5 class="card-title">
                                Anda yakin validasi aduan ini?
                            </h5>
                            <p class="card-text mt-5">
                                Nama Aduan : {{ $aduan->judul_masalah }}
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Saya Yakin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="card-footer">
        <div id="carouselAduanImage" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($aduan->foto as $foto)
                <li data-target="#carouselAduanImage" data-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" @endif></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($aduan->foto as $foto)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <img src="{{ asset('storage/aduan/'. $foto-> foto) }}" class="d-block w-100" alt="...">
                </div>
                @endforeach
            </div>
            <a style="background-color: #292b2c" class="carousel-control-prev" href="#carouselAduanImage" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a style="background-color: #292b2c" class="carousel-control-next" href="#carouselAduanImage" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection
