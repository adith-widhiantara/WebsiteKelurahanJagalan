<?php

namespace App\Http\Controllers\Admin\Antrian;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Events\PanggilAntrianEvent;
use App\Http\Controllers\Controller;
use App\Models\Antrian\JenisAntrian;
use App\Models\Antrian\NomorAntrian;
use Illuminate\Support\Facades\Auth;
use App\Events\ShowCountAntrianEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class AntrianController extends Controller
{
    public function pendaftaran()
    {
        $antrianPetugasKelurahanCount = $this->antrianCount()['antrianPetugasKelurahanCount'];

        $antrianPetugasPajakCount = $this->antrianCount()['antrianPetugasPajakCount'];

        $antrianKepalaKelurahanCount = $this->antrianCount()['antrianKepalaKelurahanCount'];

        return view('page.admin.antrian.layarPendaftaran', compact('antrianPetugasKelurahanCount', 'antrianPetugasPajakCount', 'antrianKepalaKelurahanCount'));
    }

    public function pemanggilan()
    {
        $lastCalledAntrian = NomorAntrian::query()
            ->with('jenisAntrian')
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $lastAntrianPetugasKelurahan = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_kelurahan');
            })
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $lastAntrianPetugasPajak = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_pajak');
            })
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $lastAntrianKepalaKelurahan = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'kepala_kelurahan');
            })
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        return view('page.admin.antrian.layarPemanggilan', compact('lastCalledAntrian', 'lastAntrianPetugasKelurahan', 'lastAntrianPetugasPajak', 'lastAntrianKepalaKelurahan'));
    }

    public function index()
    {
        $dataAllAntrian = NomorAntrian::query()
            ->with('jenisAntrian')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('page.admin.antrian.index', compact('dataAllAntrian'));
    }

    public function indexToday()
    {
        $dataAntrianPetugasKelurahan = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_kelurahan');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('status', '<=', '1')
            ->get();

        $dataAntrianPetugasPajak = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_pajak');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('status', '<=', '1')
            ->get();

        $dataAntrianKepalaKelurahan = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'kepala_kelurahan');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('status', '<=', '1')
            ->get();

        return view('page.admin.antrian.indexToday', compact('dataAntrianPetugasKelurahan', 'dataAntrianPetugasPajak', 'dataAntrianKepalaKelurahan'));
    }

    public function petugasKelurahanStore(Request $request)
    {
        $request->validate([
            'nik' => ['required']
        ]);

        $user = User::firstWhere('nomor_ktp', $request->nik);
        $jenisAntrian = JenisAntrian::firstWhere('slug', 'petugas_kelurahan');
        $lastThisAntrian = NomorAntrian::query()
            ->where('antrian_jenis_id', $jenisAntrian->id)
            ->latest()
            ->first();

        if (!$user) {
            return back()->with('danger', 'Nomok NIK tidak terdaftar');
        }

        if (!$lastThisAntrian) {
            $lastThisAntrianCount = 1;
        } else {
            $lastThisAntrianDate = Carbon::parse($lastThisAntrian->created_at)->isoFormat('Y-M-d');
            $nowDate = Carbon::now()->isoFormat('Y-M-d');
            if ($lastThisAntrianDate != $nowDate) {
                $lastThisAntrianCount = 1;
            } else {
                $lastThisAntrianCount = $lastThisAntrian->angka_antrian + 1;
            }
        }

        $nomorAntrian = $jenisAntrian->nomorAntrian()->create([
            'user_id' => $user->id,
            'nomor_antrian' => $jenisAntrian->code . '-' . $lastThisAntrianCount,
            'angka_antrian' => $lastThisAntrianCount
        ]);

        $fileName = $nomorAntrian->id . '_' . $nomorAntrian->user_id . '.pdf';

        return $this->printPdfAntrian($nomorAntrian, $fileName);
        // return back()->with('success', 'Berhasil didaftarkan');
    }

    public function petugasPajakStore(Request $request)
    {
        $request->validate([
            'nik' => ['required']
        ]);

        $user = User::firstWhere('nomor_ktp', $request->nik);
        $jenisAntrian = JenisAntrian::firstWhere('slug', 'petugas_pajak');
        $lastThisAntrian = NomorAntrian::query()
            ->where('antrian_jenis_id', $jenisAntrian->id)
            ->latest()
            ->first();

        if (!$user) {
            return back()->with('danger', 'Nomok NIK tidak terdaftar');
        }

        if (!$lastThisAntrian) {
            $lastThisAntrianCount = 1;
        } else {
            $lastThisAntrianDate = Carbon::parse($lastThisAntrian->created_at)->isoFormat('Y-M-d');
            $nowDate = Carbon::now()->isoFormat('Y-M-d');
            if ($lastThisAntrianDate != $nowDate) {
                $lastThisAntrianCount = 1;
            } else {
                $lastThisAntrianCount = $lastThisAntrian->angka_antrian + 1;
            }
        }

        $nomorAntrian = $jenisAntrian->nomorAntrian()->create([
            'user_id' => $user->id,
            'nomor_antrian' => $jenisAntrian->code . '-' . $lastThisAntrianCount,
            'angka_antrian' => $lastThisAntrianCount
        ]);

        $fileName = $nomorAntrian->id . '_' . $nomorAntrian->user_id . '.pdf';

        return $this->printPdfAntrian($nomorAntrian, $fileName);
        // return back()->with('success', 'Berhasil didaftarkan');
    }

    public function kepalaKelurahanStore(Request $request)
    {
        $request->validate([
            'nik' => ['required']
        ]);

        $user = User::firstWhere('nomor_ktp', $request->nik);
        $jenisAntrian = JenisAntrian::firstWhere('slug', 'kepala_kelurahan');
        $lastThisAntrian = NomorAntrian::query()
            ->where('antrian_jenis_id', $jenisAntrian->id)
            ->latest()
            ->first();

        if (!$user) {
            return back()->with('danger', 'Nomok NIK tidak terdaftar');
        }

        if (!$lastThisAntrian) {
            $lastThisAntrianCount = 1;
        } else {
            $lastThisAntrianDate = Carbon::parse($lastThisAntrian->created_at)->isoFormat('Y-M-d');
            $nowDate = Carbon::now()->isoFormat('Y-M-d');
            if ($lastThisAntrianDate != $nowDate) {
                $lastThisAntrianCount = 1;
            } else {
                $lastThisAntrianCount = $lastThisAntrian->angka_antrian + 1;
            }
        }

        $nomorAntrian = $jenisAntrian->nomorAntrian()->create([
            'user_id' => $user->id,
            'nomor_antrian' => $jenisAntrian->code . '-' . $lastThisAntrianCount,
            'angka_antrian' => $lastThisAntrianCount
        ]);

        $fileName = $nomorAntrian->id . '_' . $nomorAntrian->user_id . '.pdf';

        return $this->printPdfAntrian($nomorAntrian, $fileName);
        // return back()->with('success', 'Berhasil didaftarkan');
    }

    private function printPdfAntrian($nomorAntrian, $fileName)
    {
        $pdf = PDF::loadView('page.admin.antrian.print', ['data' => $nomorAntrian->nomor_antrian]);
        $pdf->save(base_path() . '/storage/app/public/antrian/antrian.pdf');
        Storage::move('public/antrian/antrian.pdf', 'public/antrian/' . $fileName);

        $pdfUrl = Storage::path('public/antrian/' . $fileName);
        return response()->file($pdfUrl);
    }

    public function antrianTerima(Request $request, NomorAntrian $dataAntrian)
    {
        $dataAntrian->update([
            'petugas' => Auth::id(),
            'status' => 1,
            'called_at' => now()
        ]);

        $lastCalledAntrian = NomorAntrian::query()
            ->with('jenisAntrian')
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $lastAntrianPetugasKelurahan = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_kelurahan');
            })
            ->with('jenisAntrian')
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $lastAntrianPetugasPajak = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_pajak');
            })
            ->with('jenisAntrian')
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $lastAntrianKepalaKelurahan = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'kepala_kelurahan');
            })
            ->with('jenisAntrian')
            ->with('user')
            ->whereNotNull('called_at')
            ->where('status', '<', 2)
            ->orderBy('called_at', 'desc')
            ->first();

        $data = [
            'lastCalledAntrian' => $lastCalledAntrian,
            'lastAntrianPetugasKelurahan' => $lastAntrianPetugasKelurahan,
            'lastAntrianPetugasPajak' => $lastAntrianPetugasPajak,
            'lastAntrianKepalaKelurahan' => $lastAntrianKepalaKelurahan
        ];

        event(new PanggilAntrianEvent($data));

        $antrianPetugasKelurahanCount = $this->antrianCount()['antrianPetugasKelurahanCount'];
        $antrianPetugasPajakCount = $this->antrianCount()['antrianPetugasPajakCount'];
        $antrianKepalaKelurahanCount = $this->antrianCount()['antrianKepalaKelurahanCount'];

        $showCount = [
            'antrianPetugasKelurahanCount' => $antrianPetugasKelurahanCount,
            'antrianPetugasPajakCount' => $antrianPetugasPajakCount,
            'antrianKepalaKelurahanCount' => $antrianKepalaKelurahanCount,
        ];

        event(new ShowCountAntrianEvent($showCount));

        return back()->with('success', 'Antrian berhasil dipanggil');
    }

    public function antrianSelesai(Request $request, NomorAntrian $dataAntrian)
    {
        $dataAntrian->update([
            'status' => 2
        ]);

        $antrianPetugasKelurahanCount = $this->antrianCount()['antrianPetugasKelurahanCount'];
        $antrianPetugasPajakCount = $this->antrianCount()['antrianPetugasPajakCount'];
        $antrianKepalaKelurahanCount = $this->antrianCount()['antrianKepalaKelurahanCount'];

        $showCount = [
            'antrianPetugasKelurahanCount' => $antrianPetugasKelurahanCount,
            'antrianPetugasPajakCount' => $antrianPetugasPajakCount,
            'antrianKepalaKelurahanCount' => $antrianKepalaKelurahanCount,
        ];

        event(new ShowCountAntrianEvent($showCount));

        return back()->with('success', 'Antrian telah selesai');
    }

    public function antrianTidakSelesai(Request $request, NomorAntrian $dataAntrian)
    {
        $dataAntrian->update([
            'status' => 3
        ]);

        $antrianPetugasKelurahanCount = $this->antrianCount()['antrianPetugasKelurahanCount'];
        $antrianPetugasPajakCount = $this->antrianCount()['antrianPetugasPajakCount'];
        $antrianKepalaKelurahanCount = $this->antrianCount()['antrianKepalaKelurahanCount'];

        $showCount = [
            'antrianPetugasKelurahanCount' => $antrianPetugasKelurahanCount,
            'antrianPetugasPajakCount' => $antrianPetugasPajakCount,
            'antrianKepalaKelurahanCount' => $antrianKepalaKelurahanCount,
        ];

        event(new ShowCountAntrianEvent($showCount));

        return back()->with('warning', 'Antrian Tidak Ada Orang');
    }

    public function antrianCount()
    {
        $antrianPetugasKelurahanCount = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_kelurahan');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('status', '<=', 1)
            ->count();

        $antrianPetugasPajakCount = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_pajak');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('status', '<=', 1)
            ->count();

        $antrianKepalaKelurahanCount = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'kepala_kelurahan');
            })
            ->whereDate('created_at', Carbon::today())
            ->where('status', '<=', 1)
            ->count();

        $data = [
            'antrianPetugasKelurahanCount' => $antrianPetugasKelurahanCount,
            'antrianPetugasPajakCount' => $antrianPetugasPajakCount,
            'antrianKepalaKelurahanCount' => $antrianKepalaKelurahanCount
        ];

        return $data;
    }
}
