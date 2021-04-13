<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PengaturanWarga\DataKematian;

class DataKematianController extends Controller
{
    public function index()
    {
        $dataKematian = DataKematian::latest()
            ->get();
        $dataKartuKeluarga = KartuKeluarga::all();

        return view('page.admin.pengaturanWarga.kematian.index', compact('dataKematian', 'dataKartuKeluarga'));
    }

    public function create(KartuKeluarga $kartuKeluarga)
    {
        $user = User::with('anggota.kartu')
            ->doesntHave('kelahiran')
            ->doesntHave('kematian')
            ->doesntHave('masuk')
            ->doesntHave('keluar')
            ->whereHas('anggota.kartu', function (Builder $query) use ($kartuKeluarga) {
                $query->where('id', $kartuKeluarga->id);
            })->get();

        return view('page.admin.pengaturanWarga.kematian.create', compact('kartuKeluarga', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor_id' => 'required',
            'user_id' => 'required',
            'tanggal_meninggal' => 'required',
            'tempat_meninggal' => 'required',
            'sebab_meninggal' => 'required',
            'keterangan' => 'nullable',
        ]);

        if ($request->nama_pelapor_id == $request->user_id) {
            return back()->with('error', 'Data nama pelapor dan data nama meninggal adalah sama!');
        }

        DataKematian::create([
            'nama_pelapor_id' => $request->nama_pelapor_id,
            'user_id' => $request->user_id,
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'tempat_meninggal' => $request->tempat_meninggal,
            'sebab_meninggal' => $request->sebab_meninggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.kematian.index')->with('success', 'Data Kematian berhasil diisi!');
    }

    public function show(DataKematian $dataKematian)
    {
        return view('page.admin.pengaturanWarga.kematian.show', compact('dataKematian'));
    }
}
