<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MingguPembelajaran extends Model
{
    use HasFactory;

    protected $table = 'minggu_pembelajaran';
    protected $fillable = ['lokasi_penugasan_id', 'minggu_pembelajaran', 'tanggal_mulai', 'tanggal_berakhir'];

    public function lokasiTugas()
    {
        return $this->belongsTo(LokasiTugas::class, 'lokasi_penugasan_id');
    }

}
