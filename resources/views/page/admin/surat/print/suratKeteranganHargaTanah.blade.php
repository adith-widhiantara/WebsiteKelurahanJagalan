<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4,
        .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h4,
        .h4 {
            font-size: 1.5rem;
        }

        .table {
            color: #212529;
        }

        .table th,
        .table td {}

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-bottom: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        th,
        tr,
        td,
        p,
        div {
            line-height: 1.1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }
    </style>

    <title>{{ $surat['title'] }}</title>
</head>

<body>
    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 10px; padding: 0.75rem; vertical-align: top; border-bottom: 1px solid #71767a;">
                    <img src="{{ $data['header']['logo'] }}" height="100">
                </td>
                <td style="padding: 0.75rem; vertical-align: top; border-bottom: 1px solid #71767a;">
                    <h3 style="text-align: center">Pemerintah Kota Kediri</h3>
                    <h3 style="text-align: center">Kecamatan Kota</h3>
                    <h1 style="text-align: center">Kelurahan Jagalan</h1>
                    <p style="text-align: center">{{ $data['header']['alamat'] }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-bottom: 1rem; width: 100%">
        <tbody>
            <tr>
                <td>
                    <h1 style="text-align: center; text-decoration: underline;">{{ $surat['title'] }}</h1>
                    <h3 style="text-align: center">Nomor Surat : {{ $surat['nomor_surat'] }}</h3>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px; text-indent: 30px">
                        Yang bertanda tangan dibawah ini Kepala Kelurahan Jagalan, Kecamatan Kota, Kota Kediri, dengan ini menerangkan bahwa :
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-left: 30px;">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">Nama</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['nama'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">Nomor KTP / NIK</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['nomorktp'].' / '.$surat['self']['nik'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">Tempat/Tanggal Lahir</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['tempat_tanggal_lahir'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">Pekerjaan</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['pekerjaan'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">Alamat</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['alamat'] }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px; text-indent: 30px">
                        Nama yang tersebut diatas adalah benar Warga Penduduk Kelurahan Jagalan dan telah terdaftar dalam buku Induk Kependudukan, dan nama tersebut di atas adalah benar memiliki sebidang tanah beserta bangunan diatasnya sesuai dengan data sebagai berikut :
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-left: 30px;">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Nomor Sertifikat
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['nomor_sertifikat'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Atas Nama
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['atas_nama_sertifikat'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Luas Tanah
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['luas_tanah'] }} M²
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Adapun batas-batas tanah tersebut sebagai berikut :
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-left: 30px;">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Sebelah utara berbatasan dengan
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['utara'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Sebelah selatan berbatasan dengan
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['selatan'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Sebelah timur berbatasan dengan
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['timur'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Sebelah barat berbatasan dengan
                    </p>
                </td>
                <td>
                    <p style="font-size: 12px">
                        : {{ $surat['self']['barat'] }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">
                        Harga tafsiran tanah saat ini berkisar {{ $surat['self']['harga_tafsiran_tanah'] }} per M²<br>
                        Harga tafsiran bangunan rumah saat ini berkisar {{ $surat['self']['harga_tafsiran_bangunan'] }} per M²
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class=" table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px; text-indent: 30px">
                        Demikianlah surat keterangan ini kami keluarkan untuk dapat dimaklumi dan dipergunakan semestinya.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="float: right; margin-top: 50px;">
        <p style="font-size: 12px">{{ $data['footer']['placeDate'] }}</p>
        <p style="font-size: 12px">Kepala Kelurahan Jagalan</p>
        <img src="{{ $data['footer']['ttd'] }}" height="100">
        <p style="font-size: 12px">{{ $data['footer']['person'] }}</p>
    </div>
</body>

</html>
