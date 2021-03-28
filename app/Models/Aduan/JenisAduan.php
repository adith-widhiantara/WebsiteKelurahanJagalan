<?php

namespace App\Models\Aduan;

use App\Models\Aduan\Aduan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAduan extends Model
{
    use HasFactory;

    protected $table = 'jenis_aduans';

    protected $fillable = [
        'nama_aduan',
        'slug',
        'keterangan',
    ];

    public function aduan()
    {
        return $this->hasMany(Aduan::class);
    }
}
