<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanWebsite extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_website';

    protected $fillable = [
        'name',
        'description',
    ];
}
