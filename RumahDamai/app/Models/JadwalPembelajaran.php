<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPembelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pembelajaran';
    protected $fillable = [
        'kelas_id',
        'minggu_pembelajaran_id',
        'modul_materi_id',
        'guru_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mingguPembelajaran()
    {
        return $this->belongsTo(MingguPembelajaran::class, 'minggu_pembelajaran_id');
    }

    public function modulMateri()
    {
        return $this->belongsTo(ModulMateri::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
