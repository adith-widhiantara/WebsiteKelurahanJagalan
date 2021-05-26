<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengurusPegawaiRequest extends FormRequest
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
            'alamat' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            'bagian_kerja' => ['required']
        ];
    }
}
