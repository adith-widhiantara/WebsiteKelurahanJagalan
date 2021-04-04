<?php

namespace App\Http\Controllers\Admin\KartuKeluarga;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga\Gelar;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataKeluargaRequest;
use App\Models\KartuKeluarga\Agama;
use App\Models\KartuKeluarga\GolonganDarah;
use App\Models\KartuKeluarga\Pekerjaan;
use App\Models\KartuKeluarga\Pendidikan;
use App\Models\KartuKeluarga\PenyandangCacat;
use App\Models\KartuKeluarga\StatusHubunganKepala;
use App\Models\KartuKeluarga\StatusPerkawinan;

class TabelKartuKeluargaController extends Controller
{
    public function index()
    {
        $gelar = Gelar::all();
        $golonganDarah = GolonganDarah::all();
        $agama = Agama::all();
        $statusPerkawinan = StatusPerkawinan::all();
        $statusHubunganKepala = StatusHubunganKepala::all();
        $penyandangCacat = PenyandangCacat::all();
        $pendidikanTerakhir = Pendidikan::all();
        $pekerjaan = Pekerjaan::all();

        return view('page.admin.keluarga.tabel.index', compact('gelar', 'golonganDarah', 'agama', 'statusPerkawinan', 'statusHubunganKepala', 'penyandangCacat', 'pendidikanTerakhir', 'pekerjaan'));
    }

    public function storeGelar(DataKeluargaRequest $request)
    {
        Gelar::create($request->validated());

        return back()->with('success', 'Gelar Berhasil Ditambahkan');
    }

    public function updateGelar(DataKeluargaRequest $request, Gelar $gelar)
    {
        $gelar->update($request->validated());

        return back()->with('success', 'Gelar Berhasil Diubah');
    }

    public function storeGolonganDarah(DataKeluargaRequest $request)
    {
        GolonganDarah::create($request->validated());

        return back()->with('success', 'Gelar Berhasil Ditambahkan');
    }

    public function updateGolonganDarah(DataKeluargaRequest $request, GolonganDarah $golonganDarah)
    {
        $golonganDarah->update($request->validated());

        return back()->with('success', 'Golongan Darah Berhasil Diubah');
    }

    public function storeAgama(DataKeluargaRequest $request)
    {
        Agama::create($request->validated());

        return back()->with('success', 'Agama Berhasil Ditambahkan');
    }

    public function updateAgama(DataKeluargaRequest $request, Agama $agama)
    {
        $agama->update($request->validated());

        return back()->with('success', 'Agama Berhasil Diubah');
    }

    public function storeStatusPerkawinan(DataKeluargaRequest $request)
    {
        StatusPerkawinan::create($request->validated());

        return back()->with('success', 'Status Perkawinan Berhasil Ditambahkan');
    }

    public function updateStatusPerkawinan(DataKeluargaRequest $request, StatusPerkawinan $statusPerkawinan)
    {
        $statusPerkawinan->update($request->validated());

        return back()->with('success', 'Status Perkawinan Berhasil Diubah');
    }

    public function storeStatusHubunganKepala(DataKeluargaRequest $request)
    {
        StatusHubunganKepala::create($request->validated());

        return back()->with('success', 'Status Hubungan Dengan Kepala Keluarga Berhasil Ditambahkan');
    }

    public function updateStatusHubunganKepala(DataKeluargaRequest $request, StatusHubunganKepala $statusHubunganKepala)
    {
        $statusHubunganKepala->update($request->validated());

        return back()->with('success', 'Status Hubungan Dengan Kepala Keluarga Berhasil Diubah');
    }

    public function storePenyandangCacat(DataKeluargaRequest $request)
    {
        PenyandangCacat::create($request->validated());

        return back()->with('success', 'Penyandang Cacat Berhasil Ditambahkan');
    }

    public function updatePenyandangCacat(DataKeluargaRequest $request, PenyandangCacat $penyandangCacat)
    {
        $penyandangCacat->update($request->validated());

        return back()->with('success', 'Penyandang Cacat Berhasil Diubah');
    }

    public function storePendidikan(DataKeluargaRequest $request)
    {
        Pendidikan::create($request->validated());

        return back()->with('success', 'Pendidikan Berhasil Ditambahkan');
    }

    public function updatePendidikan(DataKeluargaRequest $request, Pendidikan $pendidikan)
    {
        $pendidikan->update($request->validated());

        return back()->with('success', 'Pendidikan Berhasil Diubah');
    }

    public function storePekerjaan(DataKeluargaRequest $request)
    {
        Pekerjaan::create($request->validated());

        return back()->with('success', 'Pekerjaan Berhasil Ditambahkan');
    }

    public function updatePekerjaan(DataKeluargaRequest $request, Pekerjaan $pekerjaan)
    {
        $pekerjaan->update($request->validated());

        return back()->with('success', 'Pekerjaan Berhasil Diubah');
    }
}
