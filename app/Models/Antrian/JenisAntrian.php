<?php

namespace App\Models\Antrian;

use App\Models\Antrian\NomorAntrian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAntrian extends Model
{
    use HasFactory;

    protected $table = 'antrian_jenis';

    protected $guarded = [];

    public function nomorAntrian()
    {
        return $this->hasMany(NomorAntrian::class, 'antrian_jenis_id');
    }
}
