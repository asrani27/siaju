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
        Schema::table('pengajuan_revisi', function (Blueprint $table) {
            // Check if column exists before adding
            if (!Schema::hasColumn('pengajuan_revisi', 'pengajuan_id')) {
                $table->unsignedBigInteger('pengajuan_id')->nullable()->after('id');
            }
            // Add foreign key constraint
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan')->cascadeOnDelete()->comment('FK ke pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_revisi', function (Blueprint $table) {
            $table->dropForeign(['pengajuan_id']);
            $table->dropColumn('pengajuan_id');
        });
    }
};
