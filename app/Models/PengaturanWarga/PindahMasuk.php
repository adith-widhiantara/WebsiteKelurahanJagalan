<?php

namespace App\Models\PengaturanWarga;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahMasuk extends Model
{
    use HasFactory;

    protected $table = 'data_pindah_masuks';

    protected $fillable = [
        'user_id',
        'alamat_asal',
        'tanggal_surat',
        'nomor_surat',
        'file_surat',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
