<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = auth()->user()->vehicles()->latest()->paginate(10);

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plat_nomor' => ['required', 'string', 'max:20'],
            'nama_kendaraan' => ['nullable', 'string', 'max:100'],
            'jenis_kendaraan' => ['required', 'in:Motor,Mobil'],
        ]);

        $validated['user_id'] = auth()->id();

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('status', 'vehicle-created');
    }

    public function edit(Vehicle $vehicle)
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'plat_nomor' => ['required', 'string', 'max:20'],
            'nama_kendaraan' => ['nullable', 'string', 'max:100'],
            'jenis_kendaraan' => ['required', 'in:Motor,Mobil'],
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('status', 'vehicle-updated');
    }

    public function destroy(Vehicle $vehicle)
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('status', 'vehicle-deleted');
    }
}