<?php

namespace App\Models\Surat;

use App\Models\User;
use App\Models\Surat\Jenis;
use App\Models\Surat\Usaha;
use App\Models\Surat\Ditolak;
use App\Models\Surat\BedaNama;
use App\Models\Surat\HargaTanah;
use App\Models\Surat\Penghasilan;
use App\Models\Surat\Persyaratan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrasi extends Model
{
    use HasFactory;

    protected $table = 'surat_administrasi';

    protected $fillable = [
        'user_id',
        'surat_jenis_id',
        'keperluan',
        'file_surat',
        'pesan',
        'status',
        'keterangan',
    ];

    public function getPenghasilan()
    {
        return 'Rp.' . number_format($this->penghasilan->penghasilan, 2);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'surat_jenis_id');
    }

    public function usaha()
    {
        return $this->hasOne(Usaha::class, 'surat_administrasi_id');
    }

    public function bedaNama()
    {
        return $this->hasOne(BedaNama::class, 'surat_administrasi_id');
    }

    public function penghasilan()
    {
        return $this->hasOne(Penghasilan::class, 'surat_administrasi_id');
    }

    public function hargaTanah()
    {
        return $this->hasOne(HargaTanah::class, 'surat_administrasi_id');
    }

    public function ditolak()
    {
        return $this->hasOne(Ditolak::class, 'surat_administrasi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
