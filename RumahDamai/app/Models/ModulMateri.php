<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulMateri extends Model
{
    use HasFactory;

    protected $table = 'modul_materi';
    protected $fillable = [
        'kelas_id',
        'nama_materi',
        'deskripsi',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id'); // Sesuaikan dengan nama kolom relasinya (kelas_id)
    }
}
