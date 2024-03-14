<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak';

    protected $fillable = [
        'foto_profil',
        'nama_lengkap',
        'agama_id',
        'jenis_kelamin_id',
        'golongan_darah_id',
        'kebutuhan_id',
        'penyakit_id',
        'tempatLahir',
        'tanggalLahir',
        'tanggal_masuk',
        'tanggal_keluar',
        'disukai',
        'tidak_disukai',
        'alamat',
        'kelebihan',
        'kekurangan',
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class, 'golongan_darah_id');
    }

    public function kebutuhan()
    {
        return $this->belongsTo(Kebutuhan::class, 'kebutuhan_id');
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }
}
