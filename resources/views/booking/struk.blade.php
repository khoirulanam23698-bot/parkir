<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Parkir</title>
    <style>
        body { font-family: monospace; width: 280px; margin: 0 auto; padding: 16px; font-size: 13px; }
        h2 { text-align: center; margin: 0 0 4px; font-size: 16px; }
        .center { text-align: center; }
        hr { border: none; border-top: 1px dashed #002fff; margin: 8px 0; }
        table { width: 100%; }
        td { padding: 2px 0; }
        .right { text-align: right; }
        .total { font-weight: bold; font-size: 14px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h2>Parkir Kabasa</h2>
    <p class="center">Struk Parkir</p>
    <hr>
    <table>
        <tr><td>No. Booking</td><td class="right">#{{ $booking->id }}</td></tr>
        <tr><td>Plat Kendaraan</td><td class="right">{{ $booking->plat_kendaraan }}</td></tr>
        @if($booking->nama_kendaraan)
        <tr><td>Nama Kendaraan</td><td class="right">{{ $booking->nama_kendaraan }}</td></tr>
        @endif
        @if($booking->slot)
        <tr><td>Slot</td><td class="right">{{ $booking->slot->kode_slot }}</td></tr>
        @endif
        <tr><td>Jam Masuk</td><td class="right">{{ optional($booking->waktu_masuk)->format('d/m/Y H:i') ?? '-' }}</td></tr>
        <tr><td>Jam Keluar</td><td class="right">{{ optional($booking->waktu_keluar)->format('d/m/Y H:i') ?? '-' }}</td></tr>
        <tr><td>Status</td><td class="right">{{ ucfirst($booking->status) }}</td></tr>
    </table>
    <hr>
    <table>
        <tr><td>Metode Bayar</td><td class="right">{{ $booking->payment->metode ?? '-' }}</td></tr>
        <tr><td>Status Bayar</td><td class="right">{{ ucfirst($booking->payment->status ?? '-') }}</td></tr>
        <tr class="total"><td>Total Bayar</td><td class="right">Rp{{ number_format($booking->payment->jumlah ?? 0, 0, ',', '.') }}</td></tr>
    </table>
    <hr>
    <p class="center">Terimakasih sudah parkir di Kabasa mohon untuk hati-hati di jalan dan tetap patuhi peraturan lalulintas:)</p>
    <p class="center">@kabasa_parkir_yuk</p>

    <div class="no-print center" style="margin-top:16px;">
        <button onclick="window.print()">Cetak</button>
    </div>
</body>
</html>