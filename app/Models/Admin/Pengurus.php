<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'users_data_pengurus';

    protected $fillable = [
        'user_id',
        'terakhir_masuk_sistem',
        'warga_jagalan',
        'alamat',
        'bagian_kerja',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
