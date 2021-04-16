<!DOCTYPE html>
<html lang="en">

<head>
    <title>Surat Pindah Keluar</title>
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
</head>

<body>
    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 10px; padding: 0.75rem; vertical-align: top; border-bottom: 1px solid #71767a;">
                    <img src="{{ $data['data']['logo'] }}" height="100">
                </td>
                <td style="padding: 0.75rem; vertical-align: top; border-bottom: 1px solid #71767a;">
                    <h3 style="text-align: center">Pemerintah Kota Kediri</h3>
                    <h3 style="text-align: center">Kecamatan Kota</h3>
                    <h1 style="text-align: center">Kelurahan Jagalan</h1>
                    <p style="text-align: center">{{ $data['data']['alamat'] }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-bottom: 1rem; width: 100%">
        <tbody>
            <tr>
                <td>
                    <h1 style="text-align: center">Surat Keterangan Pindah Keluar</h1>
                    <h3 style="text-align: center">Nomor Surat : {{ $data['data']['nomor_surat']['format'].$data['data']['nomor_surat']['index'] }}</h3>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">Yang bertanda tangan dibawah ini Kepala Kelurahan Jagalan, Kecamatan Kota, Kota Kediri, Jawa Timur</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">Dengan ini menerangkan bahwa :</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-left: 30px;">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">a.</p>
                </td>
                <td>
                    <p style="font-size: 12px">Nama</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['self']['nama'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">b.</p>
                </td>
                <td>
                    <p style="font-size: 12px">Tempat/Tanggal Lahir</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['self']['tempat_lahir'].', '.$data['self']['tanggal_lahir'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">c.</p>
                </td>
                <td>
                    <p style="font-size: 12px">Jenis Kelamin</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['self']['jenis_kelamin'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">d.</p>
                </td>
                <td>
                    <p style="font-size: 12px">Pekerjaan</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['self']['pekerjaan'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">e.</p>
                </td>
                <td>
                    <p style="font-size: 12px">Alamat</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['self']['alamat'] }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">Telah pindah keluar :</p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="margin-left: 30px;">
        <tbody>
            <tr>
                <td>
                    <p style="font-size: 12px">Alamat Asal</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['pindahKeluar']['alamat'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">Tanggal Surat</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['pindahKeluar']['tanggal'] }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 12px">Nomor Surat</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['pindahKeluar']['nomor'] }}</p>
                </td>
            </tr>
            @isset($data['pindahKeluar']['keterangan'])
            <tr>
                <td>
                    <p style="font-size: 12px">Keterangan</p>
                </td>
                <td>
                    <p style="font-size: 12px">: {{ $data['pindahKeluar']['keterangan'] }}</p>
                </td>
            </tr>
            @endisset
        </tbody>
    </table>

    <table class="table" style="width: 100%">
        <tbody>x
            <tr>
                <td>
                    <p style="font-size: 12px">Demikian surat keterangan pindah keluar ini dibuat untuk dapat digunakan seperlunya.</p>
                </td>
            </tr>
        </tbody>
    </table>



    <div style="float: right; margin-top: 50px;">
        <p style="font-size: 12px">{{ $data['bottom']['place'].', '.$data['bottom']['date'] }}</p>
        <p style="font-size: 12px">Kepala Kelurahan Jagalan</p>
        <img src="{{ $data['bottom']['ttd'] }}" height="100">
        <p style="font-size: 12px">{{ $data['bottom']['person'] }}</p>
    </div>
</body>

</html>
