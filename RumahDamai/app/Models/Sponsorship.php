<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $table = 'sponsorship';
    protected $fillable = ['id','jenis_sponsorship','deskripsi'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
