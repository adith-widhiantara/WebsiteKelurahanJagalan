@extends('base.admin')

@php
$title = $jenisSurat -> nama_surat;
@endphp

@section('title')
{{ $title }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.jenis.show', $jenisSurat) }}
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
            <form action="{{ route('admin.jenis.update', $jenisSurat->id) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>
                            Nama Surat
                        </label>
                        <input type="text" class="form-control" value="{{ $jenisSurat->nama_surat }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>
                            Format Surat
                        </label>
                        <input type="text" class="form-control" placeholder="Cth. Format Surat" name="format_nomor_surat" value="{{ $jenisSurat->format_nomor_surat }}" required>
                    </div>

                    <div class="form-group">
                        <label>
                            Keterangan
                        </label>
                    </div>
                    <textarea id="summernote" name="keterangan">
                    {{ $jenisSurat->keterangan }}
                    </textarea>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
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
<script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()
    })
</script>
@endsection
