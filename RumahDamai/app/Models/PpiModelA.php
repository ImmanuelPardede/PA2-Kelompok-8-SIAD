<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpiModelA extends Model
{
    use HasFactory;

    protected $table = 'ppi_model_a'; // Menentukan nama tabel yang digunakan

    protected $fillable = [
        'anak_id',
        'user_id',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
