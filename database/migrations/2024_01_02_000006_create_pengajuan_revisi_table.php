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
        Schema::create('pengajuan_revisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_file_id')->constrained('pengajuan_file')->cascadeOnDelete()->comment('FK ke pengajuan_file');
            $table->text('catatan')->comment('Catatan revisi');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->comment('User yang membuat revisi');
            $table->timestamps();

            // Indexes
            $table->index('pengajuan_file_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_revisi');
    }
};
