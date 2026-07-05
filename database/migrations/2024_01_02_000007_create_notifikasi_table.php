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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->comment('FK ke users');
            $table->string('judul', 255)->comment('Judul notifikasi');
            $table->text('isi')->comment('Isi pesan notifikasi');
            $table->string('url', 500)->nullable()->comment('URL redirect');
            $table->boolean('is_read')->default(false)->comment('Status sudah dibaca');
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
