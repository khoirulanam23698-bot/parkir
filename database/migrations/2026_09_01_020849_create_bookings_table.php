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
        Schema::create('bookings', function (Blueprint $table) {
             $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('parking_slot_id')->constrained()->onDelete('cascade');
        $table->string('plat_kendaraan');
        $table->string('nama_kendaraan')->nullable();
        $table->dateTime('waktu_masuk');
        $table->dateTime('waktu_keluar')->nullable();
        $table->enum('status', ['booked', 'aktif', 'selesai', 'dibatalkan'])->default('booked');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
