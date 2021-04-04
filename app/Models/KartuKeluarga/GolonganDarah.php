<?php

namespace App\Models\KartuKeluarga;

use App\Models\Warga\AnggotaKeluarga;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganDarah extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga_golongan_darah';

    protected $fillable = [
        'keterangan'
    ];

    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }
}
