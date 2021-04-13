<?php

namespace App\Models\PengaturanWarga;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKematian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelapor_id',
        'user_id',
        'tanggal_meninggal',
        'tempat_meninggal',
        'sebab_meninggal',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
