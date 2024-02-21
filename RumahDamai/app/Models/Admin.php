<?php 
// Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // foreign key to connect to the User model
        'nama',
        'tempat_lahir',
        // tambahkan kolom lainnya sesuai kebutuhan
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
