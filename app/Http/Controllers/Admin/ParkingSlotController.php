<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingSlot;
use App\Models\ParkingArea;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    public function index()
    {
        $slots = ParkingSlot::with('area')->latest()->get();
        $areas = ParkingArea::all();
        return view('admin.slots.index', compact('slots', 'areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_slot' => 'required|unique:parking_slots,kode_slot',
            'jenis' => 'required|in:motor,mobil',
            'parking_area_id' => 'required|exists:parking_areas,id',
        ]);

        ParkingSlot::create($request->only('kode_slot', 'jenis', 'parking_area_id'));

        return back()->with('success', 'Slot berhasil ditambahkan.');
    }

    public function destroy(ParkingSlot $slot)
    {
        $slot->delete();
        return back()->with('success', 'Slot dihapus.');
    }
}