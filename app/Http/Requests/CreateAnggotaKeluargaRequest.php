<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnggotaKeluargaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => ['required', 'string', 'max:255', 'unique:users'],
            'nomor_ktp' => ['required', 'string', 'unique:users'],
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
        ];
    }
}
