<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inovasi extends Model
{
    protected $table = 'inovasis';

    protected $primaryKey = 'id_inovasi';

    public $timestamps = false;

    protected $fillable = [
        'id_UMKM',
        'nama_inovasi',
        'kategori',
        'deskripsi',
        'gambar',
        'status',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_UMKM', 'id_UMKM');
    }
}