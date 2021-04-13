<?php

namespace App\Models\PengaturanWarga;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelahiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelapor_id',
        'user_id',
        'nomor_anak',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
