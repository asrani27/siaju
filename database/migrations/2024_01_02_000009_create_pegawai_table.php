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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 50)->unique()->comment('Nomor Induk Pegawai');
            $table->string('nama', 255)->comment('Nama lengkap pegawai');
            $table->string('skpd', 255)->comment('Satuan Kerja Perangkat Daerah');
            $table->string('telp', 20)->nullable()->comment('Nomor telepon');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->comment('FK ke users');
            $table->timestamps();

            // Indexes
            $table->index('nip');
            $table->index('skpd');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
