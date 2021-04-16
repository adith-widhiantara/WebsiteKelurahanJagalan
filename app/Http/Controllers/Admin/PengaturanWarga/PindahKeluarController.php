<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PengaturanWarga\PindahMasuk;
use App\Models\PengaturanWarga\PindahKeluar;

class PindahKeluarController extends Controller
{
    public function index()
    {
        $dataPindahKeluar = PindahKeluar::latest()
            ->get();
        $dataKartuKeluarga = KartuKeluarga::all();

        return view('page.admin.pengaturanWarga.pindahKeluar.index', compact('dataPindahKeluar', 'dataKartuKeluarga'));
    }

    public function create(KartuKeluarga $kartuKeluarga)
    {
        $user = User::with('anggota.kartu')
            ->doesntHave('kematian')
            ->doesntHave('keluar')
            ->whereHas('anggota.kartu', function (Builder $query) use ($kartuKeluarga) {
                $query->where('id', $kartuKeluarga->id);
            })->get();

        return view('page.admin.pengaturanWarga.pindahKeluar.create', compact('kartuKeluarga', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_tujuan' => ['required', 'min:8'],
            'tanggal_surat' => ['required', 'date'],
            'nomor_surat' => ['required', 'min:8'],
            'file_surat' => ['required', 'file', 'max:5120'],
            'keterangan' => ['nullable'],
        ]);

        $user = User::findOrFail($request->user_id);

        $user->keluar()->create([
            'alamat_tujuan' => $request->alamat_tujuan,
            'tanggal_surat' => $request->tanggal_surat,
            'nomor_surat' => $request->nomor_surat,
            'file_surat' => $user->id . '_' . $request->file('file_surat')->getClientOriginalName(),
            'keterangan' => $request->keterangan,
        ]);

        $request->file('file_surat')->storeAs(
            'public/berkas_pindah_keluar',
            $user->id . '_' . $request->file('file_surat')->getClientOriginalName()
        );

        return redirect()->route('admin.pindahkeluar.index')->with('success', 'Data Pindah Keluar Berhasil Ditambahkan');
    }

    public function show($pindahKeluar)
    {
        $dataPindahKeluar = PindahKeluar::with('user')->find($pindahKeluar);

        return view('page.admin.pengaturanWarga.pindahKeluar.show', compact('dataPindahKeluar'));
    }

    public function showFile(PindahKeluar $pindahKeluar)
    {
        $path = Storage::path('public/berkas_pindah_keluar/' . $pindahKeluar->file_surat);
        return response()->file($path);
    }
}
