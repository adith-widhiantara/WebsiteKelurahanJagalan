<?php

namespace App\Models\Aduan\NonValid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoNonValid extends Model
{
    use HasFactory;

    protected $table = 'non_valid_fotos';

    protected $fillable = [
        'photo',
        'user_id'
    ];

    public function nonValidAduan()
    {
        return $this->belongsTo(NonValidAduan::class);
    }
}
