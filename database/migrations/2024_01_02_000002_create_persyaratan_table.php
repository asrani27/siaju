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
        Schema::create('persyaratan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanan')->cascadeOnDelete()->comment('FK ke tabel layanan');
            $table->string('nama', 255)->comment('Nama persyaratan');
            $table->text('keterangan')->nullable()->comment('Keterangan detail persyaratan');
            $table->boolean('is_required')->default(true)->comment('Apakah persyaratan wajib');
            $table->integer('urutan')->default(1)->comment('Urutan tampil');
            $table->timestamps();

            // Indexes
            $table->index('layanan_id');
            $table->index('is_required');
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persyaratan');
    }
};
