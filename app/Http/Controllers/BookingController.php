<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ParkingSlot;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Models\ParkingTariff;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $slots = ParkingSlot::with('area')->where('status', 'tersedia')->get();
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

        $tariff = ParkingTariff::where('jenis_kendaraan', $slot->jenis)
            ->where('is_active', true)
            ->first();

        if (!$tariff) {
            return back()->with('error', 'Tarif untuk jenis kendaraan ini belum diatur.');
        }

        Payment::create([
            'booking_id' => $booking->id,
            'jumlah' => $tariff->tarif_awal,
            'status' => 'pending',
        ]);

        ActivityLog::create([
            'user' => auth()->user()->name,
            'activity' => 'Membuat Booking',
            'details' => "Slot {$slot->kode_slot} dipesan untuk kendaraan {$request->plat_kendaraan}",
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

        ActivityLog::create([
            'user' => auth()->user()->name,
            'activity' => 'Melakukan Pembayaran',
            'details' => "Pembayaran booking #{$booking->id} via {$request->metode}",
        ]);

        return back()->with('success', 'Pembayaran berhasil.');
    }

    public function checkout(Booking $booking)
    {
        $waktuKeluar = now();
        $jam = max(1, ceil($booking->waktu_masuk->diffInMinutes($waktuKeluar) / 60));

        $tariff = ParkingTariff::where('jenis_kendaraan', $booking->slot->jenis)
            ->where('is_active', true)
            ->first();

        $totalBiaya = $tariff->tarif_awal;
        if ($jam > 1) {
            $totalBiaya += ($jam - 1) * $tariff->tarif_per_jam;
        }

        $booking->update([
            'waktu_keluar' => $waktuKeluar,
            'status' => 'selesai',
        ]);
        $booking->slot->update(['status' => 'tersedia']);
        $booking->payment->update(['jumlah' => $totalBiaya]);

        ActivityLog::create([
            'user' => auth()->user()->name,
            'activity' => 'Checkout Booking',
            'details' => "Booking #{$booking->id} selesai, {$jam} jam, total Rp" . number_format($totalBiaya),
        ]);

        return back()->with('success', 'Checkout berhasil. Total biaya: Rp' . number_format($totalBiaya));
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