<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatarBelakang extends Model
{
    use HasFactory;

    protected $table = 'latar_belakang';
    protected $fillable = [
        'anak_id',
        'user_id',
        'usia',
        'kelas',
        'tanggal',
        'deskripsi'
    ];

    public function uploadImage()
    {
        return $this->hasMany(GambarLatarBelakang::class, 'latar_belakang_id', 'id');
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id', 'id');
    }

    public function gambarLatarBelakang()
    {
        return $this->hasMany(GambarLatarBelakang::class, 'latar_belakang_id');
    }

    public function deskripsiLatarBelakang()
    {
        return $this->hasMany(DeskripsiLatarBelakang::class, 'latar_belakang_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
