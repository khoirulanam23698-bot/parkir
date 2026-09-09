<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['user_id', 'plat_nomor', 'nama_kendaraan', 'jenis_kendaraan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}