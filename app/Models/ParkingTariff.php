<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingTariff extends Model
{
    protected $fillable = ['jenis_kendaraan', 'tarif_awal', 'tarif_per_jam', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}