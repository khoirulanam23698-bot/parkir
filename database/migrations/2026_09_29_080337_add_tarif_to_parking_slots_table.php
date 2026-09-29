<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::table('parking_slots', function (Blueprint $table) {
            $table->integer('tarif')->default(2000);
        });
    }

    public function down(): void
    {
        Schema::table('parking_slots', function (Blueprint $table) {
         $table->dropColumn('tarif');
        });
    }
};
