<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'status',
        'role',
        'nip',
        'golongan_darah_id',
        'jenis_kelamin_id',
        'agama_id',
        'pendidikan_id',
        'alamat',
        'tanggal_masuk',
        'tanggal_keluar',
        'tempat_lahir',
        'tanggal_lahir',
        'lokasi_penugasan_id',
        'foto',
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["admin", "guru", "staff"][$value],
        );
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class, 'golongan_darah_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_id');
    }

    public function Lokasi()
    {
        return $this->belongsTo(Pendidikan::class, 'lokasi_penugasan_id');
    }

}
