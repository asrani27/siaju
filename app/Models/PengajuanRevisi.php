<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanRevisi extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_revisi';

    protected $fillable = [
        'pengajuan_id',
        'pengajuan_file_id',
        'catatan',
        'created_by',
    ];

    /**
     * Get the pengajuan that owns the revision.
     */
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /**
     * Get the persyaratan that needs revision.
     */
    public function persyaratan(): BelongsTo
    {
        return $this->belongsTo(Persyaratan::class);
    }

    /**
     * Get the user who created the revision.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
