<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRaport extends Model
{
    use HasFactory;

    protected $table = 'detailraports'; // Tentukan nama tabel yang sesuai

    protected $fillable = [
        'raport_id',
        'mata_pelajaran_id',
        'grade',
        'keterangan',
    ];

    public function raport()
    {
        return $this->belongsTo(Raport::class);
    }

    public function matapelajaran()
    {
        return $this->belongsTo(Kelas::class, 'mata_pelajaran_id');

    }
    
}
