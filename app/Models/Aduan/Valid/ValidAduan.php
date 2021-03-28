<?php

namespace App\Models\Aduan\Valid;

use App\Models\Aduan\Aduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidAduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function commentKepala()
    {
        return $this->hasOne(CommentKepalaValid::class);
    }

    public function commentRW()
    {
        return $this->hasOne(CommentRWValid::class);
    }

    public function foto()
    {
        return $this->hasMany(FotoValid::class);
    }

    public function commentWarga()
    {
        return $this->hasOne(CommentWargaValid::class);
    }
}
