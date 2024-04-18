<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPPIModelA extends Model
{
    use HasFactory;

    protected $table = 'detail_PPI_Model_A'; // Menyatakan nama tabel yang terkait

    protected $fillable = [
        'ppiA_id',
        'gambaran_sensory',
        'data_medis',
        'hal_disukai',
        'kondisi_lain',
    ];


    public function ppiA()
    {
        return $this->belongsTo(PPI_Model_A::class, 'ppiA_id');
    }

    // Definisikan relasi ke model Tujuan
/*     public function tujuanpendek()
    {
        return $this->belongsTo(TujuanPendek::class, 'tujuan_pendek_id');
    }
    public function tujuanpanjang()
    {
        return $this->belongsTo(TujuanPanjang::class, 'tujuan_panjang_id');
    } */
    
}
