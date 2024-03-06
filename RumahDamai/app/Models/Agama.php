<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'agama'; // Sesuaikan dengan nama tabel yang Anda buat
    protected $fillable = ['id','agama']; // Sesuaikan dengan kolom yang dapat diisi

    public function anak(){
        return $this->hasMany(Anak::class);
    }
}
