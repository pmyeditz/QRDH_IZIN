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
        Schema::create('izin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 18)->unique();
            $table->string('alasan');
            $table->date('mulai_tgl');
            $table->date('sampai_tgl');
            $table->enum('status', ['pulang', 'keperluan', 'darurat']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin');
    }
};
