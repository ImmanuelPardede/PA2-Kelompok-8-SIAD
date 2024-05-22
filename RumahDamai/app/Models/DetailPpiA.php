<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPpiA extends Model
{
    use HasFactory;

    protected $table = 'detail_ppi_a'; // Menentukan nama tabel yang digunakan


    protected $fillable = [
        'ppiA_id',
        'level_komunikasi',
        'gambaran_sensorik',
        'informasi_penting',
        'kondisi_lain',
        'layanan_lain',
        'tujuan_jangka_panjang',
        'tujuan_jangka_pendek',
    ];

    public function ppiModelA()
    {
        return $this->belongsTo(PpiModelA::class, 'ppiA_id');
    }
}
