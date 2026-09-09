<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingTariff;
use Illuminate\Http\Request;

class ParkingTariffController extends Controller
{
    public function index()
    {
        $tariffs = ParkingTariff::latest()->paginate(10);

        return view('admin.tariffs.index', compact('tariffs'));
    }

    public function create()
    {
        return view('admin.tariffs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kendaraan' => ['required', 'string', 'max:100'],
            'tarif_awal' => ['required', 'integer', 'min:0'],
            'tarif_per_jam' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        ParkingTariff::create($validated);

        return redirect()->route('admin.tariffs.index')->with('status', 'tariff-created');
    }

    public function edit(ParkingTariff $tariff)
    {
        return view('admin.tariffs.edit', compact('tariff'));
    }

    public function update(Request $request, ParkingTariff $tariff)
    {
        $validated = $request->validate([
            'jenis_kendaraan' => ['required', 'string', 'max:100'],
            'tarif_awal' => ['required', 'integer', 'min:0'],
            'tarif_per_jam' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $tariff->update($validated);

        return redirect()->route('admin.tariffs.index')->with('status', 'tariff-updated');
    }

    public function destroy(ParkingTariff $tariff)
    {
        $tariff->delete();

        return redirect()->route('admin.tariffs.index')->with('status', 'tariff-deleted');
    }
}