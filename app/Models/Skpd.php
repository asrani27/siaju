<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skpd extends Model
{
    use HasFactory;

    protected $table = 'skpd';

    protected $fillable = [
        'kode_skpd',
        'nama_skpd',
        'user_id',
    ];

    /**
     * Get the user that owns the Skpd.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
