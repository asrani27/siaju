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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->comment('User yang melakukan aksi');
            $table->foreignId('pengajuan_id')->nullable()->constrained('pengajuan')->cascadeOnDelete()->comment('Pengajuan terkait');
            $table->string('aksi', 100)->comment('Nama aksi yang dilakukan');
            $table->string('ip_address', 45)->nullable()->comment('IP address user');
            $table->string('device', 255)->nullable()->comment('Device/browser info');
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('pengajuan_id');
            $table->index('aksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
