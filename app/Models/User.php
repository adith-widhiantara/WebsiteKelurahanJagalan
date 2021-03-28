<?php

namespace App\Models;

use App\Models\Aduan\Aduan;
use App\Models\News\News;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nomor_ktp',
        'password',
        'nomor_telepon',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'nomor_ktp_verified_at' => 'datetime',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function aduan()
    {
        return $this->hasMany(Aduan::class);
    }
}
