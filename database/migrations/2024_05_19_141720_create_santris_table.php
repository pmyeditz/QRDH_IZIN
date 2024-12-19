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
        Schema::create('santris', function (Blueprint $table) {
            $table->increments('idSantri');
            $table->string('slug', 18)->unique();
            $table->string('nama', 30);
            $table->string('nis', 11)->unique();
            $table->string('alamat', 100);
            $table->string('no_hp', 12);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('foto', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
