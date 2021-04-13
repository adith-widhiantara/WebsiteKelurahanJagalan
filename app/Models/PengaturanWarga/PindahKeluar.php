<?php

namespace App\Models\PengaturanWarga;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PindahKeluar extends Model
{
    use HasFactory;

    protected $table = 'data_pindah_keluars';

    protected $fillable = [
        'user_id',
        'alamat_tujuan',
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
