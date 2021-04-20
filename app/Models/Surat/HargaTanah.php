<?php

namespace App\Models\Surat;

use App\Models\Surat\Administrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HargaTanah extends Model
{
    use HasFactory;

    protected $table = 'surat_harga_tanah';

    protected $fillable = [
        'surat_administrasi_id',
        'nomor_sertifikat',
        'atas_nama_sertifikat',
        'luas_tanah',
        'batas_tanah_utara',
        'batas_tanah_selatan',
        'batas_tanah_timur',
        'batas_tanah_barat',
        'harga_tafsiran_tanah',
        'harga_tafsiran_bangunan',
        'fileSertifikatTanah',
    ];

    public function surat()
    {
        return $this->belongsTo(Administrasi::class, 'surat_administrasi_id');
    }
}
