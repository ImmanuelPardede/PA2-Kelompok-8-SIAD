<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganDarah extends Model
{
    use HasFactory;
    protected $table = 'golongan_darah'; // Sesuaikan dengan nama tabel yang Anda buat
    protected $fillable = ['id','golongan_darah']; // Sesuaikan dengan kolom yang dapat diisi


    public function anak(){
        return $this->hasMany(Anak::class);
    }
}


