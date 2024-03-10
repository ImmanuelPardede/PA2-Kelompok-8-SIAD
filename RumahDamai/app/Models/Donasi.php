<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';
    protected $fillable = ['id','jenis_donasi','deskripsi'];

    public function anak(){
        return $this->hasMany(Anak::class);
    }
}
