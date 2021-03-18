@extends('base.admin')

@section('title')
{{ $news -> title }}
@endsection

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.news.show', $news) }}
@endsection

@section('base')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Ubah Berita
                </h3>
            </div>
            <form action="{{ route('admin.news.put', $news->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-warning" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="title">Sampul Berita</label>
                        <img src="{{ asset('image/news/'.$news->photo) }}" alt="" class="img-fluid">
                    </div>

                    <div class="form-group">
                        <label for="title">Judul Berita</label>
                        <input type="text" class="form-control" id="title" placeholder="Masukkan Judul" name="title"
                            value="{{ $news->title }}">
                    </div>

                    <div class="form-group">
                        <label for="photoNews">Sampul Berita</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photoNews" name="photo">
                                <label class="custom-file-label" for="photoNews">Pilih Gambar</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            Harap upload foto sampul berita kembali
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Kategori Berita</label>
                        <select class="form-control select2" name="category_id">
                            <option value="">...</option>
                            @foreach (\App\Models\News\Category::all() as $cat)
                            <option @if ( $news->category_id == $cat->id ) selected="selected" @endif
                                value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Berita</label>
                        <textarea id="summernote" name="description">{{ $news->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($news->show == 1)
                    <a href="#" class="btn btn-danger btn-xs"
                        onclick="event.preventDefault(); document.getElementById('hide-form').submit();">
                        Sembunyikan<br>Berita
                    </a>
                    @elseif($news->show == 0)
                    <a href="#" class="btn btn-success btn-xs"
                        onclick="event.preventDefault(); document.getElementById('show-form').submit();">
                        Tampilkan<br>Berita
                    </a>
                    @endif
                    <button type="submit" class="btn btn-primary float-right">
                        Simpan
                    </button>
                </div>
            </form>

            @if ($news->show == 1)
            <form style="display: none" action="{{ route('admin.news.hide', $news->slug) }}" method="post"
                id="hide-form">
                @csrf
                @method('put')
            </form>
            @elseif($news->show == 0)
            <form style="display: none" action="{{ route('admin.news.showPut', $news->slug) }}" method="post"
                id="show-form">
                @csrf
                @method('put')
            </form>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Summernote -->
<script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function() {
        // Summernote
        $('#summernote').summernote({
            placeholder: 'Silakan Tulis Berita Disini',
            tabsize: 2,
            height: 100
        });

        // Select2
        $('.select2').select2();

        // bs-custom-file-input
        bsCustomFileInput.init();
    });
</script>
@endsection