<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanHistory extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_history';

    protected $fillable = [
        'pengajuan_id',
        'status',
        'judul',
        'keterangan',
        'user_id',
    ];
    
    /**
     * Alias for status field to maintain compatibility.
     * The migration uses 'status' but some code uses 'status_baru'.
     */
    public function setStatusBaruAttribute($value)
    {
        $this->attributes['status'] = $value;
    }
    
    public function getStatusBaruAttribute()
    {
        return $this->attributes['status'];
    }

    /**
     * Get the pengajuan that owns the history.
     */
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /**
     * Get the user that owns the history.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
