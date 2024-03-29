<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donatur';
    protected $fillable = [
        'nama_donatur',
        'email_donatur',
        'no_hp_donatur',
        'jumlah_donasi',
        'foto_donatur',
    ];

    public function donasi()
    {
        return $this->belongsToMany(Donasi::class, 'donatur_donasi', 'donatur_id', 'donasi_id');
    }
}
