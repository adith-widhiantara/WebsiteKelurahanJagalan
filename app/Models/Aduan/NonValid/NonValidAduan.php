<?php

namespace App\Models\Aduan\NonValid;

use App\Models\Aduan\Aduan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonValidAduan extends Model
{
    use HasFactory;

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function foto()
    {
        return $this->hasMany(FotoNonValid::class);
    }

    public function comment()
    {
        return $this->hasOne(CommentNonValid::class);
    }
}
