<?php

namespace App\Http\Controllers\Admin\PengaturanWarga;

use PDF;
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
            ->doesntHave('masuk')
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

    public function showPDF(DataKelahiran $dataKelahiran)
    {
        // $getNama = Str::slug($dataKelahiran->user->nama, '_');

        // $pdf = PDF::loadView('page.admin.pengaturanWarga.kelahiran.showPDF', ['dataKelahiran' => $dataKelahiran]);
        // return $pdf->download('data_kelahiran_' . $getNama . '.pdf');
    }

    public function showViewPDF(DataKelahiran $dataKelahiran)
    {
        return view('page.admin.pengaturanWarga.kelahiran.showPDF', compact('dataKelahiran'));
    }
}
