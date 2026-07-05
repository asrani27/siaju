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
        Schema::create('pengajuan_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->cascadeOnDelete()->comment('FK ke pengajuan');
            $table->string('status', 50)->comment('Status saat history ini dibuat');
            $table->string('judul', 255)->comment('Judul/history');
            $table->text('keterangan')->nullable()->comment('Keterangan detail');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->comment('User yang melakukan aksi');
            $table->timestamps();

            // Indexes
            $table->index('pengajuan_id');
            $table->index('status');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_history');
    }
};
