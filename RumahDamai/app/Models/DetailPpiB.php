<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPpiB extends Model
{
    use HasFactory;

    protected $table = 'detail_ppi_b'; // Menentukan nama tabel yang digunakan


    protected $fillable = [
        'ppiB_id',
        'file_ppi_b',
        'deskripsi',
    ];

    public function ppiModelB()
    {
        return $this->belongsTo(PpiModelB::class, 'ppiB_id');
    }
}
