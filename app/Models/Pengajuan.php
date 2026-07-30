<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    /**
     * Status constants
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_DIKIRIM = 'dikirim';
    const STATUS_VERIFIKASI = 'verifikasi';
    const STATUS_REVISI = 'revisi';
    const STATUS_DIPROSES = 'diproses';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_DIBATALKAN = 'dibatalkan';

    protected $fillable = [
        'nomor_pengajuan',
        'user_id',
        'layanan_id',
        'skpd_id',
        'tanggal_pengajuan',
        'status',
        'catatan_user',
        'tanggal_selesai',
        'sk_file',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Get the user that owns the pengajuan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the layanan that owns the pengajuan.
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    /**
     * Get the skpd that owns the pengajuan.
     */
    public function skpd(): BelongsTo
    {
        return $this->belongsTo(Skpd::class);
    }

    /**
     * Get the files for this pengajuan.
     */
    public function files(): HasMany
    {
        return $this->hasMany(PengajuanFile::class);
    }

    /**
     * Get the history for this pengajuan.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(PengajuanHistory::class);
    }

    /**
     * Get the revisions for this pengajuan.
     */
    public function revisions(): HasMany
    {
        return $this->hasMany(PengajuanRevisi::class);
    }

    /**
     * Check if pengajuan is in final status
     */
    public function isFinal(): bool
    {
        return in_array($this->status, [
            self::STATUS_SELESAI,
            self::STATUS_DITOLAK,
            self::STATUS_DIBATALKAN,
        ]);
    }

    /**
     * Get status badge color class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'bg-gray-100 text-gray-600',
            self::STATUS_DIKIRIM => 'bg-blue-100 text-blue-600',
            self::STATUS_VERIFIKASI => 'bg-yellow-100 text-yellow-600',
            self::STATUS_REVISI => 'bg-orange-100 text-orange-600',
            self::STATUS_DIPROSES => 'bg-indigo-100 text-indigo-600',
            self::STATUS_SELESAI => 'bg-green-100 text-green-600',
            self::STATUS_DITOLAK => 'bg-red-100 text-red-600',
            self::STATUS_DIBATALKAN => 'bg-gray-100 text-gray-500',
            default => 'bg-gray-100 text-gray-600',
        };
    }

    /**
     * Get status label in Indonesian
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_DIKIRIM => 'Dikirim',
            self::STATUS_VERIFIKASI => 'Verifikasi',
            self::STATUS_REVISI => 'Revisi',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }
}
