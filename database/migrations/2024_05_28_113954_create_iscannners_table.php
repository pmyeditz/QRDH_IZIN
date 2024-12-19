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
        Schema::create('iscannners', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alasan');
            $table->date('mulai_tgl');
            $table->date('sampai_tgl');
            $table->enum('status', ['pulang', 'keperluan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iscannners');
    }
};
