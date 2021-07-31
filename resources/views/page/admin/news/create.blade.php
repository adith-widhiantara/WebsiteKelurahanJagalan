@extends('base.admin')

@section('title')
Buat Berita
@endsection

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.news.create') }}
@endsection

@section('base')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Buat Berita
                </h3>
            </div>
            <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">
                        {{ $error }}
                    </div>
                    @endforeach
                    @endif

                    <div class="form-group">
                        <label for="title">Judul Berita</label>
                        <input type="text" class="form-control" id="title" placeholder="Masukkan Judul" name="title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="photoNews">Sampul Berita</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photoNews" name="photo" required accept="image/*">
                                <label class="custom-file-label" for="photoNews">Pilih Gambar</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kategori Berita</label>
                        <select class="form-control select2" name="category_id">
                            <option value="">...</option>
                            @foreach (\App\Models\News\Category::orderBy('updated_at', 'desc')->get() as $cat)
                            <option @if ( old('category_id')==$cat->id ) selected="selected" @endif
                                value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Berita</label>
                        <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">
                        Simpan
                    </button>
                </div>
            </form>
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
