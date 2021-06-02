<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $dataUser = [
            ['Nama', $user->nama],
            ['Nomor KTP', $user->nomor_ktp],
            ['Nomor Telepon', $user->nomor_telepon],
            ['Gelar', $user->anggota->gelar->keterangan],
            ['Jenis Kelamin', $user->anggota->jenis_kelamin],
            ['Tempat Lahir', $user->anggota->tempat_lahir],
            ['Tanggal Lahir', Carbon::parse($user->anggota->tanggal_bulan_tahun_lahir)->isoFormat('dddd, D MMMM Y')],
            ['Akte Kelahiran', $user->anggota->surat_lahir],
            ['Nomor Akte Kelahiran', $user->anggota->nomor_surat_lahir],
            ['Golongan Darah', $user->anggota->golongan_darah->keterangan],
            ['Agama', $user->anggota->agama->keterangan],
            ['Kepercayaan Kepada Tuhan Yang Maha Esa', $user->anggota->kepercayaan_terhadap_tuhan_yang_maha_esa],
            ['Status Perkawinan', $user->anggota->status_perkawinan->keterangan],
            ['Akte Perkawinan', $user->anggota->buku_nikah],
            ['Nomor Akte Perkawinan', $user->anggota->nomor_buku_nikah],
            ['Tanggal Perkawinan', $user->anggota->tanggal_perkawinan ? Carbon::parse($user->anggota->tanggal_perkawinan)->isoFormat('dddd, D MMMM Y') : '-'],
            ['Akte Perceraian', $user->anggota->surat_cerai],
            ['Nomor Akte Perceraian', $user->anggota->nomor_surat_cerai],
            ['Tanggal Perceraian', $user->anggota->tanggal_perceraian ? Carbon::parse($user->anggota->tanggal_perceraian)->isoFormat('dddd, D MMMM Y') : '-'],
            ['Status Hubungan Dengan Kepala Keluarga', $user->anggota->status_hubungan->keterangan],
            ['Kelainan Fisik dan Mental', $user->anggota->kelainan_fisik],
            ['Penyandang Cacat', $user->anggota->penyandang_cacat->keterangan],
            ['Pendidikan Terakhir', $user->anggota->pendidikan->keterangan],
            ['Pekerjaan', $user->anggota->pekerjaan->keterangan],
            ['NIK Ibu', $user->anggota->nik_ibu],
            ['Nama Ibu', $user->anggota->nama_ibu],
            ['NIK Ayah', $user->anggota->nik_ayah],
            ['Nama Ayah', $user->anggota->nama_ayah],
        ];

        $kartuKeluarga = $user->anggota->kartu;

        if ($kartuKeluarga->anggota()->where('status_hubungan_kepala_id', 1)->count() > 0) {
            $getName = $kartuKeluarga->anggota()->where('status_hubungan_kepala_id', 1)->firstOrFail()->user_id;
            $namaKepala = User::where('id', $getName)->firstOrFail()->nama;
        } else {
            $namaKepala = '( Kosong )';
        }

        $dataKartuKeluarga = [
            ['Nama Kepala Keluarga', $namaKepala],
            ['Alamat', $kartuKeluarga->alamat],
            ['Kode Pos', $kartuKeluarga->kode_pos],
            ['RT', $kartuKeluarga->rt],
            ['RW', $kartuKeluarga->rw],
            ['Nomor Telepon', $kartuKeluarga->telepon_rumah],
        ];

        return view('page.warga.show', compact('user', 'dataUser', 'dataKartuKeluarga'));
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        return 'oke';
    }
}
