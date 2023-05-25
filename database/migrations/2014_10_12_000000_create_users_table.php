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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('telepon');
            $table->string('alamat');
            $table->string('file_verifikasi')->nullable(); // ktp untuk sesuai domisili, surat keterangan domisili untuk ktp tidak sesuai domisili
            $table->enum('verifikasi', ['Belum terverifikasi', 'Mengajukan verifikasi', 'Perbaikan verifikasi', 'Terverifikasi']);
            $table->text('catatan_verifikasi')->nullable();
            $table->enum('status', ['Aktif', 'Non-aktif']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
