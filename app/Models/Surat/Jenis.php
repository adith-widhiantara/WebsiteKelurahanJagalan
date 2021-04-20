<?php

namespace App\Models\Surat;

use App\Models\Surat\Administrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'surat_jenis';

    protected $fillable = [
        'nama_surat',
        'slug',
        'format_nomor_surat',
        'keterangan',
    ];

    public function surat()
    {
        return $this->hasMany(Administrasi::class, 'surat_jenis_id');
    }
}
