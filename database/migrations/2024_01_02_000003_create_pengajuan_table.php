<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengajuan', 50)->unique()->comment('Nomor unik pengajuan');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->comment('FK ke users');
            $table->foreignId('layanan_id')->constrained('layanan')->cascadeOnDelete()->comment('FK ke layanan');
            $table->date('tanggal_pengajuan')->comment('Tanggal pengajuan dibuat');
            $table->enum('status', [
                'draft',
                'dikirim',
                'verifikasi',
                'revisi',
                'diproses',
                'selesai',
                'ditolak',
                'dibatalkan'
            ])->default('draft')->comment('Status pengajuan');
            $table->text('catatan_user')->nullable()->comment('Catatan dari user');
            $table->date('tanggal_selesai')->nullable()->comment('Tanggal pengajuan selesai');
            $table->string('sk_file', 255)->nullable()->comment('Path file SK yang dihasilkan');
            $table->timestamps();

            // Indexes
            $table->index('nomor_pengajuan');
            $table->index('user_id');
            $table->index('layanan_id');
            $table->index('status');
            $table->index('tanggal_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
