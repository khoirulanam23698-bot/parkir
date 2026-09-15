<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'parking_slot_id', 'plat_kendaraan',
        'nama_kendaraan', 'waktu_masuk', 'waktu_keluar', 'status'
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function slot()
    {
        return $this->belongsTo(ParkingSlot::class, 'parking_slot_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}