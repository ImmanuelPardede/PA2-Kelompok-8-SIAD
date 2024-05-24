<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeLaporan extends Model
{
    use HasFactory;

    protected $table = 'kode_laporan';
    protected $fillable = [
        'kode',
    ];
}
