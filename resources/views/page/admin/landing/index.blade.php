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
                <h3>150</h3>
                <p>Jumlah Aduan<br>Bulan Ini</p>
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
                <h3>53</h3>
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
                <h3>44</h3>
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
                <h3>65</h3>
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
                <h3 class="card-title">Aduan Warga</h3>

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
                        <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-warning" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><a href="#" class="btn btn-primary btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                </div>
                            </td>
                            <td><a href="#" class="btn btn-primary btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-danger" style="width: 30%"></div>
                                </div>
                            </td>
                            <td><a href="#" class="btn btn-primary btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                </div>
                            </td>
                            <td><a href="#" class="btn btn-primary btn-xs">Detail</a></td>
                        </tr>
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
                        <tr>
                            <td>1.</td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            <td>Brian James</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            <td>Brian James</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            <td>Brian James</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                            <td>Brian James</td>
                            <td><a href="#" class="btn btn-info btn-xs">Detail</a></td>
                        </tr>
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