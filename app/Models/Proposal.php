<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals';
    protected $primaryKey = 'id_proposal';

    protected $fillable = [
        'id_UMKM',
        'judul',
        'deskripsi_inovasi',
        'dana_dibutuhkan',
        'tanggal_pengajuan',
        'file_proposal',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_UMKM', 'id_UMKM');
    }
}