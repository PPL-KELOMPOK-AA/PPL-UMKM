<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenawaranPendanaan extends Model
{
    protected $table = 'penawaran_pendanaans';

    protected $primaryKey = 'id_penawaran';

    protected $fillable = [
        'jumlah_dana',
        'persyaratan',
        'tanggal_penawaran',
        'id_proposal',
        'id_investor',
        'status',
    ];

    protected $casts = [
        'tanggal_penawaran' => 'date',
    ];

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id_proposal');
    }

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class, 'id_investor', 'id_investor');
    }
}