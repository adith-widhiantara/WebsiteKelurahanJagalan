@extends('base.base')

@php
$title = 'Profil Saya';
@endphp

@section('title')
{{ $title }}
@endsection

@section('base')
{{-- slider --}}
@include('page.aduan.part.slider', ['title' => $title])
{{-- end slider --}}

<div class="container-fluid my-5">
    <div class="section-top-border">
        <div class="row">
            <div class="col-lg-8 col-md-8 offset-lg-2 offset-md-2">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($dataUser as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data[0] }}</td>
                            <td>{{ $data[1] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h1 class="my-5 text-center">Data Kartu Keluarga Saya</h1>
                <table class="table table-striped">
                    <tbody>
                        @foreach ($dataKartuKeluarga as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data[0] }}</td>
                            <td>{{ $data[1] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h1 class="my-5 text-center">
                    Ganti Password Saya
                </h1>
                <form method="post">
                    @csrf
                    <div class="mt-40">
                        <label>
                            Password
                        </label>
                        <input type="password" name="password" required class="single-input">
                    </div>

                    <div class="mt-40">
                        <label>
                            Ulangi Password
                        </label>
                        <input type="password" name="password-confirmation" required class="single-input">
                    </div>

                    <button type="submit" class="btn mt-5 float-right">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
