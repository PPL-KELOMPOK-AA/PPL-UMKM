<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Umkm extends Authenticatable
{
    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'nama_usaha', 'NIB',
        'bidang_usaha', 'alamat', 'status_verifikasi',
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'id_umkm', 'id_umkm');
    }

    public function kerjaSama()
    {
        return $this->hasMany(KerjaSamaPendanaan::class, 'id_umkm', 'id_umkm');
    }

    public function infografis()
    {
        return $this->hasMany(InfografisProgres::class, 'id_umkm', 'id_umkm');
    }
}
