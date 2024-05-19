<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskripsiLatarBelakang extends Model
{
    use HasFactory;
    protected $table = 'deskripsi_latar_belakang';
    protected $fillable = ['latar_belakang_id', 'deskripsi'];

    public function latarBelakang()
    {
        return $this->belongsTo(LatarBelakang::class, 'latar_belakang_id');
    }
}
