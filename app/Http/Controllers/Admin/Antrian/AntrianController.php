<?php

namespace App\Http\Controllers\Admin\Antrian;

use App\Events\PanggilAntrianEvent;
use App\Http\Controllers\Controller;
use App\Models\Antrian\JenisAntrian;
use App\Models\Antrian\NomorAntrian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function pendaftaran()
    {
        $antrianPetugasKelurahanCount = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_kelurahan');
            })
            ->whereDate('created_at', Carbon::today())
            ->count();

        $antrianPetugasPajakCount = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'petugas_pajak');
            })
            ->whereDate('created_at', Carbon::today())
            ->count();

        $antrianKepalaKelurahanCount = NomorAntrian::query()
            ->whereHas('jenisAntrian', function (Builder $query) {
                $query->where('slug', '=', 'kepala_kelurahan');
            })
            ->whereDate('created_at', Carbon::today())
            ->count();

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

        $jenisAntrian->nomorAntrian()->create([
            'user_id' => $user->id,
            'nomor_antrian' => $jenisAntrian->code . '-' . $lastThisAntrianCount,
            'angka_antrian' => $lastThisAntrianCount
        ]);

        return back()->with('success', 'Berhasil didaftarkan');
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

        $jenisAntrian->nomorAntrian()->create([
            'user_id' => $user->id,
            'nomor_antrian' => $jenisAntrian->code . '-' . $lastThisAntrianCount,
            'angka_antrian' => $lastThisAntrianCount
        ]);

        return back()->with('success', 'Berhasil didaftarkan');
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

        $jenisAntrian->nomorAntrian()->create([
            'user_id' => $user->id,
            'nomor_antrian' => $jenisAntrian->code . '-' . $lastThisAntrianCount,
            'angka_antrian' => $lastThisAntrianCount
        ]);

        return back()->with('success', 'Berhasil didaftarkan');
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

        return back()->with('success', 'Antrian berhasil dipanggil');
    }

    public function antrianSelesai(Request $request, NomorAntrian $dataAntrian)
    {
        $dataAntrian->update([
            'status' => 2
        ]);

        return back()->with('success', 'Antrian telah selesai');
    }

    public function antrianTidakSelesai(Request $request, NomorAntrian $dataAntrian)
    {
        $dataAntrian->update([
            'status' => 3
        ]);

        return back()->with('warning', 'Antrian Tidak Ada Orang');
    }
}
