<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Umkm extends Authenticatable
{
    protected $table = 'umkms';
    protected $primaryKey = 'id_UMKM';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'nama_usaha', 'NIB',
        'bidang_usaha', 'alamat', 'status_verifikasi',
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'id_UMKM', 'id_UMKM');
    }

    public function kerjaSama()
    {
        return $this->hasMany(KerjaSamaPendanaan::class, 'id_UMKM', 'id_UMKM');
    }

    public function infografis()
    {
        return $this->hasMany(InfografisProgres::class, 'id_UMKM', 'id_UMKM');
    }
}