<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nama',
        'skpd',
        'telp',
        'user_id',
    ];

    /**
     * Get the user that owns the Pegawai.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
