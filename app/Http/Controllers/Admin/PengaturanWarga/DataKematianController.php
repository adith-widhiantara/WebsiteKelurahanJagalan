<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
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
            ->doesntHave('kematian')
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

    public function showPDF($kematian)
    {
        $dataKematian = DataKematian::with('user.anggota')
            ->findOrFail($kematian);

        $data = [
            'data' => [
                'logo' => 'image/assets/Logo-Kota-Kediri.png',
                'alamat' => 'Jl. Patiunus No.69, Jagalan, Kec. Kota Kediri, Kota Kediri, Jawa Timur 64129',
                'nomor_surat' => [
                    'format' => 'surat_kematian/',
                    'index' => $dataKematian->id
                ]
            ],
            'self' => [
                'nama' => $dataKematian->user->nama,
                'tempat_lahir' => $dataKematian->user->anggota->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($dataKematian->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                'usia' => floor(Carbon::parse($dataKematian->user->anggota->tanggal_bulan_tahun_lahir)->floatDiffInYears($dataKematian->tanggal_meninggal)),
                'jenis_kelamin' => $dataKematian->user->anggota->jenis_kelamin,
                'pekerjaan' => $dataKematian->user->anggota->pekerjaan->keterangan,
                'alamat' => $dataKematian->user->anggota->kartu->alamat,
            ],
            'meninggal' => [
                'tanggal' => Carbon::parse($dataKematian->tanggal_meninggal)->isoFormat('D MMMM Y'),
                'tempat' => $dataKematian->tempat_meninggal,
                'sebab' => $dataKematian->sebab_meninggal,
                'keterangan' => $dataKematian->keterangan,
            ],
            'bottom' => [
                'place' => 'Kediri',
                'date' => now()->isoFormat('D MMMM Y'),
                'ttd' => 'image/assets/ttd.png',
                'person' => 'Drs. John Doe'
            ],
        ];

        $pdf = PDF::loadView('page.admin.pengaturanWarga.kematian.showPDF', ['data' => $data]);
        return $pdf->stream();
    }
}
