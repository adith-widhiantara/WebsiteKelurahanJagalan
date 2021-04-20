<?php

namespace App\Models\Surat;

use App\Models\Surat\Administrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BedaNama extends Model
{
    use HasFactory;

    protected $table = 'surat_beda_nama';

    protected $fillable = [
        'surat_administrasi_id',
        'jenis_surat',
        'nama_yang_tertera',
        'nomor_surat_tersebut',
        'file_surat',
    ];

    public function surat()
    {
        return $this->belongsTo(Administrasi::class, 'surat_administrasi_id');
    }
}
