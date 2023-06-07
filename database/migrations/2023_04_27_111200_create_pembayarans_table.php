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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('iuran_id')->constrained('iurans');
            $table->unsignedBigInteger('jumlah');
            $table->enum('metode', ['Offline', 'Online']);
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['Belum terverifikasi', 'Mengajukan pembayaran', 'Perbaikan pembayaran', 'Terverifikasi', 'Dibatalkan']);
            $table->text('catatan_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
