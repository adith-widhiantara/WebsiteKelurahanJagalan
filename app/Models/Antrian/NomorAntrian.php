<?php

namespace App\Models\Antrian;

use App\Models\Antrian\JenisAntrian;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NomorAntrian extends Model
{
    use HasFactory;

    protected $table = 'antrian_nomor';

    protected $guarded = [];

    public function jenisAntrian()
    {
        return $this->belongsTo(JenisAntrian::class, 'antrian_jenis_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
