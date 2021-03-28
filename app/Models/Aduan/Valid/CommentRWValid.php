<?php

namespace App\Models\Aduan\Valid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRWValid extends Model
{
    use HasFactory;

    protected $table = 'valid_rw_comment';

    protected $fillable = [
        'valid_aduan_id',
        'comment',
        'status',
        'user_id',
        'applied_at'
    ];

    public function validAduan()
    {
        return $this->belongsTo(ValidAduan::class);
    }
}
