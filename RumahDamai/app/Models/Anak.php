<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $table = 'anak';
    protected $fillable = ['namaLengkap', 'tempatLahir', 'tanggalLahir','nama_ibu','nama_ayah','nama_wali','foto_profile','disukai','tidak_disukai','alamat','kelebihan','kekurangan','agama_id','golongan_darah_id', 'jenis_kelamin_id', 'kebutuhan_id'];

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

}
