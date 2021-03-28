@extends('base.admin')

@section('title')
Halaman Admin
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.index') }}
@endsection

@section('base')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                @php
                $aduanCount = App\Models\Aduan\Aduan::whereDate('created_at', '=', \Carbon\Carbon::today())->count();
                @endphp
                <h3>{{ $aduanCount }}</h3>
                <p>Jumlah Aduan<br>Hari Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-paper"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-dark">
            <div class="inner">
                <h3>-</h3>
                <p>Jumlah Antrian<br>Untuk Besok</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                @php
                $newsCount = App\Models\News\News::whereDate('created_at', '=', \Carbon\Carbon::today())->count();
                @endphp
                <h3>{{ $newsCount }}</h3>
                <p>Jumlah Berita Milik<br>Warga Hari Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-social-buffer"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>-</h3>
                <p>Permintaan Surat<br>Warga</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-clipboard"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Aduan Warga Terbaru</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Aduan</th>
                            <th>Progress</th>
                            <th style="width: 40px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (\App\Models\Aduan\Aduan::doesntHave('nonValid')->latest()->take(4)->get() as $aduanLatest)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $aduanLatest -> judul_masalah }}</td>
                            <td>
                                <div class="progress progress-xs">
                                    @if ( $aduanLatest -> nonValid )
                                    <div class="progress-bar bg-danger" style="width: 100%"></div>
                                    @else
                                    <div class="progress-bar bg-success" style="width: {{ ($aduanLatest -> progress / 5)*100 }}%"></div>
                                    @endif
                                </div>
                            </td>
                            <td><a href="{{ route('admin.aduan.show', $aduanLatest -> slug) }}" class="btn btn-primary btn-xs">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Jumlah Antrian Hari Ini (Sisa 4 Orang)</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Kepentingan</th>
                            <th style="width: 40px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Brian James</td>
                            <td>Ambil KTP</td>
                            <td><a href="#" class="btn btn-success btn-xs">Selesai</a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Brian James</td>
                            <td>Ambil KTP</td>
                            <td><a href="#" class="btn btn-success btn-xs">Selesai</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Brian James</td>
                            <td>Ambil KTP</td>
                            <td><a href="#" class="btn btn-success btn-xs">Selesai</a></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Brian James</td>
                            <td>Ambil KTP</td>
                            <td><a href="#" class="btn btn-success btn-xs">Selesai</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Berita Warga</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @php
                $newsLatest = App\Models\News\News::latest()->take(4)->get();
                @endphp
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th style="width: 40px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsLatest as $latest)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $latest->title }}</td>
                            <td>{{ $latest->user->nama }}</td>
                            <td><a href="{{ route('admin.news.show', $latest->slug) }}" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Permintaan Surat Warga</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Surat</th>
                            <th>Keperluan</th>
                            <th style="width: 40px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Brian James</td>
                            <td>Keterangan Penduduk Jagalan</td>
                            <td>Untuk Nikah</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Brian James</td>
                            <td>Keterangan Penduduk Jagalan</td>
                            <td>Untuk Nikah</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Brian James</td>
                            <td>Keterangan Penduduk Jagalan</td>
                            <td>Untuk Nikah</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Brian James</td>
                            <td>Keterangan Penduduk Jagalan</td>
                            <td>Untuk Nikah</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
