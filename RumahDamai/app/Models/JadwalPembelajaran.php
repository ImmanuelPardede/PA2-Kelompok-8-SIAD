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
        'user_id',
        'lokasi_penugasan_id',
        'tanggal_pembelajaran',
        'hari_pembelajaran',
        'jam_mulai',
        'jam_selesai',
    ];

    protected $attributes = [
        'hari_pembelajaran' => null,
        'tanggal_pembelajaran' => null,
        'jam_mulai' => null,
        'jam_selesai' => null,
    ];

    protected $casts = [
        'tanggal_pembelajaran' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lokasiPenugasan()
    {
        return $this->belongsTo(LokasiTugas::class, 'lokasi_penugasan_id');
    }

    /**
     * Accessor untuk mendapatkan hari pembelajaran dalam bahasa Indonesia.
     *
     * @param string $value
     * @return string
     */
    public function getHariPembelajaranAttribute($value)
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        return $days[$value] ?? $value;
    }
}
