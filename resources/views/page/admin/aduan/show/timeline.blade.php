@extends('base.admin')

@section('title')
{{ $aduan -> judul_masalah }}
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.aduan.timeline', $aduan) }}
@endsection

@section('base')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    @if ( $aduan -> nonValid )
                    <span class="badge badge-danger">
                        Ditolak
                    </span>
                    @elseif ( $aduan -> valid )
                    <span class="badge badge-success">
                        Valid
                    </span>
                    @else
                    <span class="badge badge-secondary">
                        Belum Dikonfirmasi
                    </span>
                    @endif
                </h5>

                @if ( isset($aduan->valid->commentRW) )
                @role('RW')
                @if ( $aduan->valid->commentRW->status == 0 )
                <a href="#" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-tindak-lanjut-RW">
                    Tindak Lanjut
                </a>

                <div class="modal fade" id="modal-tindak-lanjut-RW">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tindak Lanjut Aduan Ini</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Aduan : {{ $aduan -> judul_masalah }}</li>
                                    <li class="list-group-item">Deskripsi : {{ $aduan -> detail_pengaduan }}</li>
                                    <li class="list-group-item">Jenis Aduan : {{ $aduan -> jenisAduan -> nama_aduan }}</li>
                                    <li class="list-group-item">Pelapor : {{ $aduan -> user -> nama }}</li>
                                </ul>
                            </div>
                            <form action="{{ route('admin.aduan.tindaklanjut.store', $aduan->slug) }}" method="post">
                                @csrf
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary">Tindak Lanjut</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif {{-- $aduan->valid->commentRW->status == 0 --}}

                @if ( $aduan->valid->commentRW->status == 1 )
                <a href="#" class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#modal-tindak-lanjut-form">
                    Kirim Bukti Penindaklanjutan
                </a>

                <div class="modal fade" id="modal-tindak-lanjut-form">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tindak Lanjut Aduan Ini</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.aduan.tindaklanjut.put', $aduan->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Komentar RW</label>
                                        <input type="text" name="comment" class="form-control" value="{{ old('comment') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Penindaklanjutan</label>
                                        <input type="file" name="foto[]" class="form-control-file" multiple required>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif {{-- $aduan->valid->commentRW->status == 1 --}}
                @endrole
                @endif {{-- isset($aduan->valid->commentRW) --}}

                @role('kepala_kelurahan')
                @if ( $aduan -> valid -> commentRW -> status >= 2 && empty($aduan -> valid -> commentKepala) )
                <a href="#" class="btn btn-xs btn-primary float-right" data-toggle="modal" data-target="#modal-komentar-kepala-kelurahan">
                    Komentar Aduan
                </a>
                <div class="modal fade" id="modal-komentar-kepala-kelurahan">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tindak Lanjut Aduan Ini</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.aduan.tindaklanjut.commentKepalaKelurahan', $aduan->slug) }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Komentar Kepala Kelurahan</label>
                                        <input type="text" name="comment" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif {{-- $aduan -> valid -> commentRW -> status >= 2 --}}
                @endrole
            </div>
            <div class="card-body">
                <div class="timeline">

                    {{-- Aduan Non Valid --}}
                    @if ($aduan -> nonValid)
                    <div class="time-label">
                        <span class="bg-danger">{{ \Carbon\Carbon::parse($aduan->nonValid->created_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-clipboard-check bg-secondary"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan->nonValid->created_at)->add('1 minutes')->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                Aduan ditutup!
                            </h3>
                            <div class="timeline-header">
                                <h5>
                                    Aduan ditutup karena telah ditolak
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-times-circle bg-danger"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan->nonValid->created_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ \App\Models\User::where('id', $aduan -> nonValid -> comment -> user_id)->first()->nama }}</a>
                                menolak aduan
                            </h3>
                            <div class="timeline-body">
                                <h4>
                                    {{ $aduan -> nonValid -> comment -> comment }}
                                </h4>
                            </div>
                            <div class="timeline-footer">
                                @foreach ($aduan -> nonValid -> foto as $key => $foto)
                                <a href="#" data-toggle="modal" data-target="#image-show-{{ $key }}">
                                    <img style="width: 150px; height: 100px; object-fit: cover" src="{{ asset('storage/aduan/nonValid/'. $foto -> photo) }}" alt="...">
                                </a>

                                <div class="modal fade" id="image-show-{{ $key }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lihat Gambar</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('storage/aduan/nonValid/'. $foto -> photo) }}" alt="" class="img-fluid">
                                            </div>
                                            <div class="modal-footer justify-content-end">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- end Aduan Non Valid --}}

                    {{-- Aduan Valid --}}
                    @if ( $aduan -> valid )
                    @isset( $aduan -> valid -> commentKepala )
                    <div class="time-label">
                        <span class="bg-success">{{ \Carbon\Carbon::parse($aduan -> valid -> commentKepala -> created_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-clipboard bg-success"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan -> valid -> commentKepala -> created_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ \App\Models\User::where('id', $aduan -> valid -> commentKepala -> user_id)->first()->nama }}</a>
                                mengomentari aduan
                            </h3>
                            <div class="timeline-body">
                                <h5>
                                    {{ $aduan -> valid -> commentKepala -> comment }}
                                </h5>
                            </div>
                            <div class="timeline-footer">

                            </div>
                        </div>
                    </div>
                    @endisset {{-- $aduan -> valid -> commentKepala --}}

                    @isset( $aduan -> valid -> commentWarga )
                    <div class="time-label">
                        <span class="bg-success">{{ \Carbon\Carbon::parse($aduan -> valid -> commentWarga -> created_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-clipboard bg-success"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan -> valid -> commentWarga -> created_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ \App\Models\User::where('id', $aduan -> valid -> commentWarga -> user_id)->first()->nama }}</a>
                                mengomentari aduan
                            </h3>
                            <div class="timeline-body">
                                <h5>
                                    {{ $aduan -> valid -> commentWarga -> comment }}
                                </h5>
                            </div>
                            <div class="timeline-footer">

                            </div>
                        </div>
                    </div>
                    @endisset {{-- $aduan -> valid -> commentWarga --}}

                    @if ( $aduan -> valid -> commentRW -> status >= 2 )
                    <div class="time-label">
                        <span class="bg-success">{{ \Carbon\Carbon::parse($aduan -> valid -> commentRW -> updated_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-camera bg-success"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan -> valid -> commentRW -> updated_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ \App\Models\User::where('id', $aduan -> valid -> commentRW -> user_id)->first()->nama }}</a>
                                menyelesaikan aduan
                            </h3>
                            <div class="timeline-body">
                                <h5>
                                    Aduan ini telah ditindaklanjut
                                </h5>
                            </div>
                            <div class="timeline-footer">
                                @foreach ($aduan -> valid -> foto as $key => $fotoTindakLanjut)
                                <a href="#" data-toggle="modal" data-target="#image-fotoTindakLanjut-{{ $key }}">
                                    <img style="width: 150px; height: 100px; object-fit: cover" src="{{ asset('storage/aduan/valid/'. $fotoTindakLanjut-> foto) }}" alt="...">
                                </a>

                                <div class="modal fade" id="image-fotoTindakLanjut-{{ $key }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lihat Gambar</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('storage/aduan/valid/'. $fotoTindakLanjut-> foto) }}" alt="" class="img-fluid">
                                            </div>
                                            <div class="modal-footer justify-content-end">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif {{-- $aduan -> valid -> commentRW -> status >= 2 --}}

                    @if ( $aduan -> valid -> commentRW -> status >= 1 )
                    <div class="time-label">
                        <span class="bg-success">{{ \Carbon\Carbon::parse($aduan -> valid -> commentRW -> applied_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-briefcase bg-success"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan -> valid -> commentRW -> applied_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ \App\Models\User::where('id', $aduan -> valid -> commentRW -> user_id)->first()->nama }}</a>
                                menerima aduan
                            </h3>
                            <div class="timeline-body">
                                <h5>
                                    Aduan ini telah diterima, dan segera ditindaklanjut
                                </h5>
                            </div>
                        </div>
                    </div>
                    @endif {{-- $aduan -> valid -> commentRW -> status == 1 --}}

                    <div class="time-label">
                        <span class="bg-success">{{ \Carbon\Carbon::parse($aduan->valid->created_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-check-circle bg-success"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan -> valid -> created_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ \App\Models\User::where('id', $aduan -> valid -> user_id)->first()->nama }}</a>
                                menerima aduan
                            </h3>
                            <div class="timeline-body">
                                <div class="d-flex justify-content-between">
                                    <h5>
                                        Aduan ini akan ditindaklanjut oleh RT/RW
                                    </h5>

                                    @role('RW')
                                    @if ( $aduan->valid->commentRW->status == 0 )
                                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-tindak-lanjut-RW">
                                        Tindak Lanjut
                                    </a>
                                    @endif {{-- $aduan->valid->commentRW->status == 0 --}}

                                    @if ( $aduan->valid->commentRW->status == 1 )
                                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-tindak-lanjut-form">
                                        Kirim Bukti Penindaklanjutan
                                    </a>
                                    @endif {{-- $aduan->valid->commentRW->status == 1 --}}
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif {{-- $aduan -> valid --}}
                    {{-- end Aduan Valid --}}

                    <div class="time-label">
                        <span class="bg-secondary">{{ \Carbon\Carbon::parse($aduan->created_at)->isoFormat('dddd, D/M/Y') }}</span>
                    </div>
                    <div>
                        <i class="fas fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($aduan->created_at)->isoFormat('HH:mm') }}
                            </span>
                            <h3 class="timeline-header">
                                <a href="#">{{ $aduan -> user -> nama }}</a>
                                membuat aduan
                            </h3>
                            <div class="timeline-body">
                                <h4>
                                    {{ $aduan -> judul_masalah }}
                                </h4>
                                {{ __('Deskripsi : ').$aduan -> detail_pengaduan }}
                            </div>
                            <div class="timeline-footer">
                                @foreach ($aduan -> foto as $key => $foto)
                                <a href="#" data-toggle="modal" data-target="#image-show-early-{{ $key }}">
                                    <img style="width: 150px; height: 100px; object-fit: cover" src="{{ asset('storage/aduan/'. $foto-> foto) }}" alt="...">
                                </a>

                                <div class="modal fade" id="image-show-early-{{ $key }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lihat Gambar</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset('storage/aduan/'. $foto-> foto) }}" alt="" class="img-fluid">
                                            </div>
                                            <div class="modal-footer justify-content-end">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection
