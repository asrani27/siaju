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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique()->comment('Kode unik layanan');
            $table->string('nama', 255)->comment('Nama layanan');
            $table->text('deskripsi')->nullable()->comment('Deskripsi layanan');
            $table->boolean('is_active')->default(true)->comment('Status aktif layanan');
            $table->timestamps();

            // Indexes
            $table->index('kode');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
