<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Investor extends Authenticatable
{
    protected $table = 'investor';
    protected $primaryKey = 'id_investor';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'nama_investor', 'dana_tersedia',
        'jenis_investor', 'status_verifikasi',
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function penawaran()
    {
        return $this->hasMany(PenawaranPendanaan::class, 'id_investor', 'id_investor');
    }

    public function kerjaSama()
    {
        return $this->hasMany(KerjaSamaPendanaan::class, 'id_investor', 'id_investor');
    }

    public function infografis()
    {
        return $this->hasMany(InfografisProgres::class, 'id_investor', 'id_investor');
    }
}
