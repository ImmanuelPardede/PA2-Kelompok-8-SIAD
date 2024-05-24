<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatLaporan extends Model
{
    use HasFactory;

    protected $table = 'format_laporan';
    protected $fillable = [
        'kode_laporan_id',
        'format_laporan',
        'nama_laporan',
    ];

    public function kodeLaporan()
    {
        return $this->belongsTo(KodeLaporan::class, 'kode_laporan_id');
    }
}
