<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Warga\KartuKeluarga;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Warga\AnggotaKeluarga;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PengaturanWarga\DataKelahiran;
use App\Http\Requests\CreateAnggotaKeluargaRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DataKelahiranController extends Controller
{
    public function index()
    {
        $dataKelahiran = DataKelahiran::latest()
            ->get();
        $dataKartuKeluarga = KartuKeluarga::all();

        return view('page.admin.pengaturanWarga.kelahiran.index', compact('dataKelahiran', 'dataKartuKeluarga'));
    }

    public function create(KartuKeluarga $kartuKeluarga)
    {
        $user = User::with('anggota.kartu')
            ->doesntHave('kelahiran')
            ->doesntHave('kematian')
            ->doesntHave('keluar')
            ->whereHas('anggota.kartu', function (Builder $query) use ($kartuKeluarga) {
                $query->where('id', $kartuKeluarga->id);
            })->get();

        return view('page.admin.pengaturanWarga.kelahiran.create', compact('kartuKeluarga', 'user'));
    }

    public function createNew(KartuKeluarga $kartuKeluarga)
    {
        return view('page.admin.pengaturanWarga.kelahiran.createNew', compact('kartuKeluarga'));
    }

    public function storeExists(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->kelahiran()->create([
            'nama_pelapor_id' => $request->nama_pelapor_id,
            'nomor_anak' => $request->nomor_anak,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.kelahiran.index')->with('success', 'Data Kelahiran Berhasil Ditambah');
    }

    public function store(CreateAnggotaKeluargaRequest $request, KartuKeluarga $kartuKeluarga)
    {
        $user = User::create([
            'nama' => $request->nama,
            'nomor_ktp' => $request->nomor_ktp,
            'password' => Hash::make('password'),
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        $user->anggota()->create([
            'kartu_keluarga_id' => $kartuKeluarga->id,
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

        return redirect()->route('admin.kelahiran.create', $kartuKeluarga->nomorkk)->with('success', 'Data Berhasil Dibuat!');
    }

    public function show(DataKelahiran $dataKelahiran)
    {
        return view('page.admin.pengaturanWarga.kelahiran.show', compact('dataKelahiran'));
    }

    public function showPDF($kelahiran)
    {
        $dataKelahiran = DataKelahiran::with('user.anggota')
            ->findOrFail($kelahiran);

        $data = [
            'data' => [
                'logo' => 'image/assets/Logo-Kota-Kediri.png',
                'alamat' => 'Jl. Patiunus No.69, Jagalan, Kec. Kota Kediri, Kota Kediri, Jawa Timur 64129',
                'nomor_surat' => [
                    'format' => 'surat_lahir/',
                    'index' => $dataKelahiran->id
                ]
            ],
            'self' => [
                'nama' => $dataKelahiran->user->nama,
                'tempat_lahir' => $dataKelahiran->user->anggota->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($dataKelahiran->user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('D MMMM Y'),
                'jenis_kelamin' => $dataKelahiran->user->anggota->jenis_kelamin,
                'pekerjaan' => $dataKelahiran->user->anggota->pekerjaan->keterangan,
                'alamat' => $dataKelahiran->user->anggota->kartu->alamat,
            ],
            'orangTua' => [
                'ayah' => $dataKelahiran->user->anggota->nama_ayah,
                'ibu' => $dataKelahiran->user->anggota->nama_ibu,
                'anak' => $dataKelahiran->nomor_anak
            ],
            'bottom' => [
                'place' => 'Kediri',
                'date' => now()->isoFormat('D MMMM Y'),
                'ttd' => 'image/assets/ttd.png',
                'person' => 'Drs. John Doe'
            ],
        ];

        $fileName =  Str::slug($data['data']['nomor_surat']['format'] . ' ' . $data['data']['nomor_surat']['index'] . ' ' . $data['self']['nama'], '_') . '.pdf';

        if (Storage::disk('local')->exists('public/kelahiran/' . $fileName)) {
            $pdfUrl = Storage::path('public/kelahiran/' . $fileName);
            return response()->file($pdfUrl);
        }

        $pdf = PDF::loadView('page.admin.pengaturanWarga.kelahiran.showPDF', ['data' => $data]);
        $pdf->save(base_path() . '/storage/app/public/kelahiran/kelahiran.pdf');
        Storage::move('public/kelahiran/kelahiran.pdf', 'public/kelahiran/' . $fileName);

        $pdfUrl = Storage::path('public/kelahiran/' . $fileName);
        return response()->file($pdfUrl);
    }

    public function showViewPDF(DataKelahiran $dataKelahiran)
    {
        return view('page.admin.pengaturanWarga.kelahiran.showPDF', compact('dataKelahiran'));
    }
}
