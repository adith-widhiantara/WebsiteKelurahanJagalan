<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PindahMasukRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PengaturanWarga\PindahMasuk;

class PindahMasukController extends Controller
{
    public function index()
    {
        $dataPindahMasuk = PindahMasuk::all();
        $dataKartuKeluarga = KartuKeluarga::all();

        return view('page.admin.pengaturanWarga.pindahMasuk.index', compact('dataPindahMasuk', 'dataKartuKeluarga'));
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

        return view('page.admin.pengaturanWarga.pindahMasuk.create', compact('kartuKeluarga', 'user'));
    }

    public function createNew(KartuKeluarga $kartuKeluarga)
    {
        return view('page.admin.pengaturanWarga.pindahMasuk.createNew', compact('kartuKeluarga'));
    }

    public function store(Request $request, KartuKeluarga $kartuKeluarga)
    {
        $request->validate([
            'user_id' => ['required'],
            'alamat_asal' => ['required', 'min:8'],
            'tanggal_surat' => ['required', 'date'],
            'nomor_surat' => ['required', 'min:8'],
            'file_surat' => ['required', 'file', 'max:5120'],
            'keterangan' => ['nullable'],
        ]);

        $user = User::findOrFail($request->user_id);

        $user->masuk()->create([
            'alamat_asal' => $request->alamat_asal,
            'tanggal_surat' => $request->tanggal_surat,
            'nomor_surat' => $request->nomor_surat,
            'file_surat' => $user->id . '_' . $request->file('file_surat')->getClientOriginalName(),
            'keterangan' => $request->keterangan,
        ]);

        $request->file('file_surat')->storeAs(
            'public/berkas_pindah_masuk',
            $user->id . '_' . $request->file('file_surat')->getClientOriginalName()
        );

        return redirect()->route('admin.pindahmasuk.index')->with('success', 'Data Pindah Masuk Berhasil Dicatat');
    }

    public function storeNew(PindahMasukRequest $request, KartuKeluarga $kartuKeluarga)
    {
        $user = User::create([
            'nama' => $request->nama,
            'nomor_ktp' => $request->nomor_ktp,
            'password' => Hash::make('12345678'),
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        $kartuKeluarga->anggota()->create([
            'user_id' => $user->id,
            'gelar_id' => $request->gelar_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_bulan_tahun_lahir' => $request->tanggal_bulan_tahun_lahir,
            'surat_lahir' => $request->surat_lahir,
            'nomor_surat_lahir' => $request->nomor_surat_lahir,
            'golongan_darah_id' => $request->golongan_darah_id,
            'agama_id' => $request->agama_id,
            'kepercayaan_terhadap_tuhan_yang_maha_esa' => $request->kepercayaan_terhadap_tuhan_yang_maha_esa,
            'status_perkawinan_id' => $request->status_perkawinan_id,
            'buku_nikah' => $request->buku_nikah,
            'nomor_buku_nikah' => $request->nomor_buku_nikah,
            'tanggal_perkawinan' => $request->tanggal_perkawinan,
            'surat_cerai' => $request->surat_cerai,
            'nomor_surat_cerai' => $request->nomor_surat_cerai,
            'tanggal_perceraian' => $request->tanggal_perceraian,
            'status_hubungan_kepala_id' => $request->status_hubungan_kepala_id,
            'kelainan_fisik' => $request->kelainan_fisik,
            'penyandang_cacat_id' => $request->penyandang_cacat_id,
            'pendidikan_terakhir_id' => $request->pendidikan_terakhir_id,
            'pekerjaan_id' => $request->pekerjaan_id,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'creator_id' => Auth::id(),
        ]);

        $user->masuk()->create([
            'alamat_asal' => $request->alamat_asal,
            'tanggal_surat' => $request->tanggal_surat,
            'nomor_surat' => $request->nomor_surat,
            'file_surat' => $user->id . '_' . $request->file('file_surat')->getClientOriginalName(),
            'keterangan' => $request->keterangan,
        ]);

        $request->file('file_surat')->storeAs(
            'public/berkas_pindah_masuk',
            $user->id . '_' . $request->file('file_surat')->getClientOriginalName()
        );

        return redirect()->route('admin.pindahmasuk.index')->with('success', 'Data Pindah Masuk Berhasil Dicatat');
    }

    public function show($pindahMasuk)
    {
        $dataPindahMasuk = PindahMasuk::with('user')->where('id', $pindahMasuk)->firstOrFail();

        return view('page.admin.pengaturanWarga.pindahMasuk.show', compact('dataPindahMasuk'));
    }

    public function showFile(PindahMasuk $pindahMasuk)
    {
        $path = Storage::path('public/berkas_pindah_masuk/' . $pindahMasuk->file_surat);
        return response()->file($path);
    }

    public function showPDF($pindahMasuk)
    {
        $dataPindahMasuk = PindahMasuk::with('user.anggota.kartu')
            ->findOrFail($pindahMasuk);

        $data = [
            'data' => [
                'logo' => 'image/assets/Logo-Kota-Kediri.png',
                'alamat' => 'Jl. Patiunus No.69, Jagalan, Kec. Kota Kediri, Kota Kediri, Jawa Timur 64129',
                'nomor_surat' => [
                    'format' => 'surat_pindah_masuk/',
                    'index' => $dataPindahMasuk->id
                ]
            ],
            'self' => [
                'nama' => $dataPindahMasuk->user->nama,
                'tempat_lahir' => $dataPindahMasuk->user->anggota->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($dataPindahMasuk->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                'jenis_kelamin' => $dataPindahMasuk->user->anggota->jenis_kelamin,
                'pekerjaan' => $dataPindahMasuk->user->anggota->pekerjaan->keterangan,
                'alamat' => $dataPindahMasuk->user->anggota->kartu->alamat,
            ],
            'pindahMasuk' => [
                'alamat' => $dataPindahMasuk->alamat_asal,
                'tanggal' => Carbon::parse($dataPindahMasuk->tanggal_surat)->isoFormat('D MMMM Y'),
                'nomor' => $dataPindahMasuk->nomor_surat,
                'keterangan' => $dataPindahMasuk->keterangan,
            ],
            'bottom' => [
                'place' => 'Kediri',
                'date' => now()->isoFormat('D MMMM Y'),
                'ttd' => 'image/assets/ttd.png',
                'person' => 'Drs. John Doe'
            ],
        ];

        $pdf = PDF::loadView('page.admin.pengaturanWarga.pindahMasuk.showPDF', ['data' => $data]);
        return $pdf->stream();
    }
}
