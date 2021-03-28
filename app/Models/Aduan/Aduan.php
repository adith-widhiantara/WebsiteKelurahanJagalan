<?php

namespace App\Models\Aduan;

use App\Models\Aduan\NonValid\NonValidAduan;
use App\Models\Aduan\Valid\ValidAduan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_aduan_id',
        'judul_masalah',
        'slug',
        'detail_pengaduan',
        'progress',
        'review',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foto()
    {
        return $this->hasMany(FotoAduan::class);
    }

    public function jenisAduan()
    {
        return $this->belongsTo(JenisAduan::class);
    }

    public function valid()
    {
        return $this->hasOne(ValidAduan::class);
    }

    public function nonValid()
    {
        return $this->hasOne(NonValidAduan::class);
    }
}
