<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingArea;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParkingAreaController extends Controller
{
    public function index()
    {
        $areas = ParkingArea::withCount('slots')->latest()->paginate(10);

        return view('admin.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', 'unique:parking_areas,code'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        ParkingArea::create($validated);

        return redirect()->route('admin.areas.index')->with('status', 'area-created');
    }

    public function edit(ParkingArea $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    public function update(Request $request, ParkingArea $area)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:20', Rule::unique('parking_areas', 'code')->ignore($area->id)],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $area->update($validated);

        return redirect()->route('admin.areas.index')->with('status', 'area-updated');
    }

    public function destroy(ParkingArea $area)
    {
        $area->delete();

        return redirect()->route('admin.areas.index')->with('status', 'area-deleted');
    }
}