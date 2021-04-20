<?php

namespace App\Models\Surat;

use App\Models\Surat\Administrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghasilan extends Model
{
    use HasFactory;

    protected $table = 'surat_penghasilan';

    protected $fillable = [
        'surat_administrasi_id',
        'penghasilan',
        'bukti_penghasilan',
    ];

    public function surat()
    {
        return $this->belongsTo(Administrasi::class, 'surat_administrasi_id');
    }
}
