<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingSlot extends Model
{
    protected $fillable = ['kode_slot', 'jenis', 'status', 'parking_area_id'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function area()
    {
        return $this->belongsTo(ParkingArea::class, 'parking_area_id');
    }

    public function tariff()
{
    return \App\Models\ParkingTariff::where('jenis_kendaraan', $this->jenis)
        ->where('is_active', true)
        ->first();
}
}