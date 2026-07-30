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
        Schema::create('skpd', function (Blueprint $table) {
            $table->id();
            $table->string('kode_skpd', 50)->unique()->comment('Kode SKPD');
            $table->string('nama_skpd', 255)->comment('Nama Satuan Kerja Perangkat Daerah');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->comment('FK ke users');
            $table->timestamps();

            // Indexes
            $table->index('kode_skpd');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpd');
    }
};
