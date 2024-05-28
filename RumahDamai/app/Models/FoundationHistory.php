<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundationHistory extends Model
{
    use HasFactory;
    protected $table = 'foundation_histories';

    protected $fillable = [
        'user_id',
        'gambar',
        'sejarah',
        'tujuan_utama',
        'dibuat',
        'jumlah_anak',
    ];


    protected $dates = [
        'dibangun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
