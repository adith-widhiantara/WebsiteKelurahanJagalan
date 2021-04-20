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
                        Yang bertanda tangan dibawah ini :
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
                    <p style="font-size: 12px">Nomor KTP</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['nomorktp'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">NIK</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['nik'] }}</p>
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
                    <p style="font-size: 12px">Jenis Kelamin</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $surat['self']['jenis_kelamin'] }}</p>
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
                        Dengan ini menyatakan, bahwa saya belum pernah menikah hingga kurun waktu yang telah ditentukan dikarenakan untuk {{ $surat['self']['pesan'] }}.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px; text-indent: 30px">
                        Surat pernyataan ini saya buat dengan sebenar-benarnya dan penuh kesadaran.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%; margin-top:30px;">
        <tbody>
            <tr>
                <td style="width: 50%">
                    <p style="font-size: 12px; text-align: center">
                        Mengetahui<br>
                        Orang tua / Wali
                    </p>
                </td>
                <td style="width: 50%">
                    <p style="font-size: 12px; text-align: center">
                        {{ $data['footer']['placeDate'] }}<br>
                        yang menyatakan,
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%; margin-top: 70px">
        <tbody>
            <tr>
                <td style="width: 50%">
                    <p style="font-size: 12px; text-align: center">
                        .........................
                    </p>
                </td>
                <td style="width: 50%">
                    <p style="font-size: 12px; text-align: center">
                        {{ $surat['self']['nama'] }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%; margin-top: 30px">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px; text-align: center">
                        Mengetahui<br>
                        Kepala Kelurahan
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <div>
    </div>

    <table class="table" style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 33%"></td>
                <td style="width: auto">
                    <img src="{{ $data['footer']['ttd'] }}" height="100" style="margin-left: 70px;">
                    <p style="font-size: 12px; text-align: center">{{ $data['footer']['person'] }}</p>
                </td>
                <td style="width: 33%"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
