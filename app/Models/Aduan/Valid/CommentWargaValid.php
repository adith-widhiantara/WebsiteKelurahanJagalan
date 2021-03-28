<?php

namespace App\Models\Aduan\Valid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentWargaValid extends Model
{
    use HasFactory;

    protected $table = 'valid_warga_comment';

    protected $fillable = [
        'valid_aduan_id',
        'comment',
        'user_id',
    ];

    public function validAduan()
    {
        return $this->belongsTo(ValidAduan::class);
    }
}
