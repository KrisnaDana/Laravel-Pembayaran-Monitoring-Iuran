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
        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->text('tujuan_transfer')->nullable(); //serialize [platform, atas nama, no]
            $table->unsignedBigInteger('jumlah'); // jumlah pembayaran diperlukan
            $table->unsignedBigInteger('terkumpul')->default(0);
            $table->unsignedBigInteger('tersisa');
            // $table->date('terakhir');
            $table->enum('status', ['Buka', 'Tutup']);
            $table->enum('jenis', ['Sekali', 'Periodik']);
            $table->date('mulai');
            $table->date('akhir')->nullable();
            $table->integer('jarak_periode')->nullable(); // dalam hari
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};
