<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kendaraan'); // motor, mobil, dll
            $table->unsignedBigInteger('tarif_awal');   // biaya jam pertama
            $table->unsignedBigInteger('tarif_per_jam'); // biaya per jam berikutnya
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_tariffs');
    }
};