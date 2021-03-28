<?php

namespace App\Models\Aduan;

use App\Models\Aduan\Aduan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoAduan extends Model
{
    use HasFactory;

    protected $table = 'foto_aduans';

    protected $fillable = [
        'aduan_id',
        'foto'
    ];

    public function aduan()
    {
        return $this->hasMany(Aduan::class);
    }
}
