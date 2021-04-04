<?php

namespace App\Models\Warga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomorkk',
        'kepala_keluarga_id',
        'alamat',
        'kode_pos',
        'rt',
        'rw',
        'telepon_rumah',
    ];

    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class)->orderBy('status_hubungan_kepala_id', 'asc');
    }
}
