<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ParkingSlot;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $slots = ParkingSlot::where('status', 'tersedia')->get();
        $myBookings = auth()->user()->bookings()->with('slot', 'payment')->latest()->get();

        return view('booking.index', compact('slots', 'myBookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parking_slot_id' => 'required|exists:parking_slots,id',
            'plat_kendaraan' => 'required|string|max:20',
            'nama_kendaraan' => 'nullable|string|max:50',
        ]);

        $slot = ParkingSlot::findOrFail($request->parking_slot_id);

        if ($slot->status !== 'tersedia') {
            return back()->with('error', 'Slot sudah terisi.');
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'parking_slot_id' => $slot->id,
            'plat_kendaraan' => $request->plat_kendaraan,
            'nama_kendaraan' => $request->nama_kendaraan,
            'waktu_masuk' => now(),
            'status' => 'aktif',
        ]);

        $slot->update(['status' => 'terisi']);

        $tarif = $slot->jenis === 'mobil' ? 5000 : 2000;
        Payment::create([
            'booking_id' => $booking->id,
            'jumlah' => $tarif,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function pay(Request $request, Booking $booking)
    {
        $request->validate(['metode' => 'required|in:tunai,transfer,qris']);

        $booking->payment->update([
            'metode' => $request->metode,
            'status' => 'lunas',
        ]);

        return back()->with('success', 'Pembayaran berhasil.');
    }

    public function checkout(Booking $booking)
    {
        $booking->update([
            'waktu_keluar' => now(),
            'status' => 'selesai',
        ]);
        $booking->slot->update(['status' => 'tersedia']);

        return back()->with('success', 'Checkout berhasil, slot kembali tersedia.');
    }

    public function cetakStruk(Booking $booking)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isPetugas() && $booking->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $booking->load('slot', 'payment');

        return view('booking.struk', compact('booking'));
    }
}