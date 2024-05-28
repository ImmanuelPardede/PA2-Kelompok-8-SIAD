<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita'; // Sesuaikan dengan nama tabel


    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'img_berita'
    ];


    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
