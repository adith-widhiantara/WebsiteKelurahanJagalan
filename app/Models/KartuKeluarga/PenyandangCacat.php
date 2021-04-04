<?php

namespace App\Models\KartuKeluarga;

use App\Models\Warga\AnggotaKeluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenyandangCacat extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga_penyandang_cacat';

    protected $fillable = [
        'keterangan'
    ];

    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }
}
