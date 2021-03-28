<?php

namespace App\Models\Aduan\Valid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoValid extends Model
{
    use HasFactory;

    protected $table = 'valid_fotos';

    protected $fillable = [
        'valid_aduan_id',
        'foto',
        'user_id',
    ];

    public function validAduan()
    {
        return $this->belongsTo(ValidAduan::class);
    }
}
