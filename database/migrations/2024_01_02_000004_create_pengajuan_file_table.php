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
        Schema::create('pengajuan_file', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->cascadeOnDelete()->comment('FK ke pengajuan');
            $table->foreignId('persyaratan_id')->constrained('persyaratan')->cascadeOnDelete()->comment('FK ke persyaratan');
            $table->string('nama_file', 255)->comment('Nama file yang diupload');
            $table->string('file', 500)->comment('Path file di storage');
            $table->string('mime', 100)->nullable()->comment('MIME type file');
            $table->bigInteger('ukuran')->nullable()->comment('Ukuran file dalam bytes');
            $table->enum('status', ['menunggu', 'disetujui', 'revisi'])->default('menunggu')->comment('Status verifikasi file');
            $table->text('catatan_admin')->nullable()->comment('Catatan dari admin');
            $table->timestamp('uploaded_at')->nullable()->comment('Waktu upload');
            $table->timestamp('approved_at')->nullable()->comment('Waktu disetujui');
            $table->foreignId('approved_by')->nullable()->constrained('users')->cascadeOnDelete()->comment('User yang menyetujui');
            $table->timestamps();

            // Indexes
            $table->index('pengajuan_id');
            $table->index('persyaratan_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_file');
    }
};
