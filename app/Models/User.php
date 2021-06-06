<?php

namespace App\Models;

use App\Models\Admin\Pengurus;
use App\Models\News\News;
use App\Models\Aduan\Aduan;
use App\Models\Antrian\NomorAntrian;
use App\Models\Surat\Administrasi;
use App\Models\Warga\AnggotaKeluarga;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\PengaturanWarga\PindahMasuk;
use App\Models\PengaturanWarga\PindahKeluar;
use App\Models\PengaturanWarga\DataKematian;
use App\Models\PengaturanWarga\DataKelahiran;
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
        'email',
        'foto',
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

    public function anggota()
    {
        return $this->hasOne(AnggotaKeluarga::class);
    }

    public function kelahiran()
    {
        return $this->hasOne(DataKelahiran::class);
    }

    public function kematian()
    {
        return $this->hasOne(DataKematian::class);
    }

    public function masuk()
    {
        return $this->hasOne(PindahMasuk::class);
    }

    public function keluar()
    {
        return $this->hasOne(PindahKeluar::class);
    }

    public function surat()
    {
        return $this->hasMany(Administrasi::class);
    }

    public function antrian()
    {
        return $this->hasMany(NomorAntrian::class);
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class, 'user_id');
    }

    public function forgetPassword()
    {
        return $this->hasOne(UserForgetPassword::class, 'user_id');
    }
}
