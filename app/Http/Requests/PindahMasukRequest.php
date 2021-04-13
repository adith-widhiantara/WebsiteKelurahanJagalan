<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PindahMasukRequest extends FormRequest
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
            'nomor_surat_lahir' => ['nullable'],
            'golongan_darah_id' => ['required'],
            'agama_id' => ['required'],
            'kepercayaan_terhadap_tuhan_yang_maha_esa' => [],
            'status_perkawinan_id' => ['required'],
            'buku_nikah' => ['required'],
            'nomor_buku_nikah' => ['nullable'],
            'tanggal_perkawinan' => ['nullable'],
            'surat_cerai' => ['required'],
            'nomor_surat_cerai' => ['nullable'],
            'tanggal_perceraian' => ['nullable'],
            'status_hubungan_kepala_id' => ['required'],
            'kelainan_fisik' => ['required'],
            'penyandang_cacat_id' => ['required'],
            'pendidikan_terakhir_id' => ['required'],
            'pekerjaan_id' => ['required'],
            'nik_ibu' => ['nullable'],
            'nama_ibu' => ['required'],
            'nik_ayah' => ['nullable'],
            'nama_ayah' => ['required'],
            'email' => ['nullable', 'email'],

            'alamat_asal' => ['required', 'min:8'],
            'tanggal_surat' => ['required', 'date'],
            'nomor_surat' => ['required', 'min:8'],
            'file_surat' => ['required', 'file', 'max:5120'],
            'keterangan' => ['nullable'],
        ];
    }
}
