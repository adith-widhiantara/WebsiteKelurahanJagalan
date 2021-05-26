<?php

namespace App\Models\Warga;

use App\Models\KartuKeluarga\Agama;
use App\Models\KartuKeluarga\Gelar;
use App\Models\KartuKeluarga\GolonganDarah;
use App\Models\KartuKeluarga\Pekerjaan;
use App\Models\KartuKeluarga\Pendidikan;
use App\Models\KartuKeluarga\PenyandangCacat;
use App\Models\KartuKeluarga\StatusHubunganKepala;
use App\Models\KartuKeluarga\StatusPerkawinan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kartu_keluarga_id',
        'gelar_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_bulan_tahun_lahir',
        'surat_lahir',
        'nomor_surat_lahir',
        'golongan_darah_id',
        'agama_id',
        'kepercayaan_terhadap_tuhan_yang_maha_esa',
        'status_perkawinan_id',
        'buku_nikah',
        'nomor_buku_nikah',
        'tanggal_perkawinan',
        'surat_cerai',
        'nomor_surat_cerai',
        'tanggal_perceraian',
        'status_hubungan_kepala_id',
        'kelainan_fisik',
        'penyandang_cacat_id',
        'pendidikan_terakhir_id',
        'pekerjaan_id',
        'nik_ibu',
        'nama_ibu',
        'nik_ayah',
        'nama_ayah',
        'creator_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kartu()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kartu_keluarga_id');
    }

    public function gelar()
    {
        return $this->belongsTo(Gelar::class);
    }

    public function golongan_darah()
    {
        return $this->belongsTo(GolonganDarah::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function status_perkawinan()
    {
        return $this->belongsTo(StatusPerkawinan::class);
    }

    public function status_hubungan()
    {
        return $this->belongsTo(StatusHubunganKepala::class, 'status_hubungan_kepala_id');
    }

    public function penyandang_cacat()
    {
        return $this->belongsTo(PenyandangCacat::class);
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_terakhir_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
