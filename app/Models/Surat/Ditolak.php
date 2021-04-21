<?php

namespace App\Models\Surat;

use App\Models\Surat\Administrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ditolak extends Model
{
    use HasFactory;

    protected $table = 'surat_decline';

    protected $fillable = [
        'surat_administrasi_id',
        'komentar',
    ];

    public function surat()
    {
        return $this->belongsTo(Administrasi::class, 'surat_administrasi_id');
    }
}
