<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    public function index()
    {
        $slots = ParkingSlot::latest()->get();
        return view('admin.slots.index', compact('slots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_slot' => 'required|unique:parking_slots,kode_slot',
            'jenis' => 'required|in:motor,mobil',
        ]);

        ParkingSlot::create($request->only('kode_slot', 'jenis'));

        return back()->with('success', 'Slot berhasil ditambahkan.');
    }

    public function destroy(ParkingSlot $slot)
    {
        $slot->delete();
        return back()->with('success', 'Slot dihapus.');
    }
}