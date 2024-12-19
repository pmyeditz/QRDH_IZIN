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
        Schema::table('izin', function (Blueprint $table) {
            $table->unsignedInteger('santri_id');
            $table->foreign('santri_id')->references('idSantri')->on('santris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izin', function (Blueprint $table) {
            $table->dropForeign(['santri_id']);
            $table->dropColumn('santri_id');
        });
    }
};
