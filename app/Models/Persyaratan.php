<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Persyaratan extends Model
{
    use HasFactory;

    protected $table = 'persyaratan';

    protected $fillable = [
        'layanan_id',
        'nama',
        'keterangan',
        'is_required',
        'urutan',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Get the layanan that owns the persyaratan.
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }
}
