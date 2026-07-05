<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanFile extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_file';

    protected $fillable = [
        'pengajuan_id',
        'persyaratan_id',
        'nama_file',
        'file',
        'mime',
        'ukuran',
        'status',
        'catatan_admin',
        'uploaded_at',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the pengajuan that owns the file.
     */
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /**
     * Get the persyaratan that owns the file.
     */
    public function persyaratan(): BelongsTo
    {
        return $this->belongsTo(Persyaratan::class);
    }

    /**
     * Get file URL
     */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file);
    }

    /**
     * Get file extension
     */
    public function getExtensionAttribute(): string
    {
        return pathinfo($this->file, PATHINFO_EXTENSION);
    }

    /**
     * Get formatted file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->ukuran;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }

    /**
     * Check if file is PDF
     */
    public function isPdf(): bool
    {
        return strtolower($this->extension) === 'pdf';
    }

    /**
     * Check if file is image
     */
    public function isImage(): bool
    {
        return in_array(strtolower($this->extension), ['jpg', 'jpeg', 'png']);
    }
}
