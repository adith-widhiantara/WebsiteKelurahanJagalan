<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KartuKeluargaRequest extends FormRequest
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
            'nomorkk' => 'required|string|size:16|unique:kartu_keluargas,nomorkk',
            'alamat' => 'required|min:8|string',
            'kode_pos' => 'required|integer',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'telepon_rumah' => 'required|string',
        ];
    }
}
