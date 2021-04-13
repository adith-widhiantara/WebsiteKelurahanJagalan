<?php

namespace App\Http\Controllers\Admin\KartuKeluarga;

use Illuminate\Http\Request;
use App\Models\Warga\KartuKeluarga;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAnggotaKeluargaRequest;
use App\Models\User;
use App\Models\Warga\AnggotaKeluarga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AnggotaKeluargaController extends Controller
{
    public function create(KartuKeluarga $kartuKeluarga)
    {
        return view('page.admin.keluarga.anggota.create', compact('kartuKeluarga'));
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

        return redirect()->route('admin.kartukeluarga.show', $kartuKeluarga->nomorkk)->with('success', 'Anggota Keluarga Berhasil Ditambah!');
    }

    public function show(KartuKeluarga $kartuKeluarga, $anggotaKeluarga)
    {
        $userKeluarga = User::where('nomor_ktp', $anggotaKeluarga)->firstOrFail();

        return view('page.admin.keluarga.anggota.show', compact('userKeluarga', 'kartuKeluarga'));
    }

    public function update(Request $request, KartuKeluarga $kartuKeluarga, $anggotaKeluarga)
    {
        $request->validate([
            'nomor_telepon' => ['required', 'string'],
            'gelar_id' => ['required'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_bulan_tahun_lahir' => ['required'],
            'surat_lahir' => ['required'],
            'nomor_surat_lahir' => [],
            'golongan_darah_id' => ['required'],
            'agama_id' => ['required'],
            'kepercayaan_terhadap_tuhan_yang_maha_esa' => [],
            'status_perkawinan_id' => ['required'],
            'buku_nikah' => ['required'],
            'nomor_buku_nikah' => [],
            'tanggal_perkawinan' => [],
            'surat_cerai' => ['required'],
            'nomor_surat_cerai' => [],
            'tanggal_perceraian' => [],
            'status_hubungan_kepala_id' => ['required'],
            'kelainan_fisik' => ['required'],
            'penyandang_cacat_id' => ['required'],
            'pendidikan_terakhir_id' => ['required'],
            'pekerjaan_id' => ['required'],
            'nik_ibu' => [],
            'nama_ibu' => ['required'],
            'nik_ayah' => [],
            'nama_ayah' => ['required'],
            'email' => ['nullable', 'email'],
        ]);

        $userKeluarga = User::where('nomor_ktp', $anggotaKeluarga)->firstOrFail();

        $userKeluarga->update([
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        $userKeluarga->anggota()->update([
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
        ]);

        return redirect()->route('admin.kartukeluarga.show', $kartuKeluarga->nomorkk)->with('success', 'Data Anggota Keluarga Berhasil Diganti');
    }
}
