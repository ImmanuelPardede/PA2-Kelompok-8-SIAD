<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;

    protected $table = 'raport'; // Menentukan nama tabel yang digunakan

    protected $fillable = [

        'tahun_ajaran_id',
        'semester_id',
        'anak_id',
        'user_id',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function semester()
    {
        return $this->belongsTo(SemesterTahunAjaran::class, 'semester_id');
    }

}
