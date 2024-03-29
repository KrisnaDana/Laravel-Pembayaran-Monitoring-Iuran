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
        Schema::create('periode_bayars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periodes');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('jumlah');
            $table->enum('status', ['Belum lunas', 'Lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_bayars');
    }
};
