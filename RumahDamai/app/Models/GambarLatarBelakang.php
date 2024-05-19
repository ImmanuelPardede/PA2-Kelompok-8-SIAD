<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarLatarBelakang extends Model
{
    use HasFactory;

    protected $table = 'gambar_latar_belakang';
    protected $fillable = ['url', 'nama', 'latar_belakang_id'];

    public function item()
    {
        return $this->belongsTo(LatarBelakang::class);
    }

    public function latarBelakang()
    {
        return $this->belongsTo(LatarBelakang::class, 'latar_belakang_id');
    }
}
