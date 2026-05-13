<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }} - TasBagus</title>
<style>
    @page { size: A4 landscape; margin: 15mm; }
    @media print { .no-print { display: none !important; } body { margin: 0; } }
    * { box-sizing: border-box; }
    body { font-family: Arial, sans-serif; font-size: 12px; color: #111; background: #fff; margin: 0; padding: 20px; }
    .header { text-align: center; border-bottom: 3px solid #f97316; padding-bottom: 12px; margin-bottom: 16px; }
    .header h1 { font-size: 20px; font-weight: 800; margin: 0 0 4px 0; color: #111; }
    .header h2 { font-size: 14px; font-weight: 600; margin: 0 0 4px 0; color: #f97316; }
    .header p  { font-size: 11px; color: #555; margin: 2px 0; }
    .summary { display: flex; gap: 16px; margin-bottom: 16px; }
    .summary-box { flex: 1; border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px 14px; text-align: center; }
    .summary-box .val { font-size: 18px; font-weight: 800; color: #f97316; }
    .summary-box .lbl { font-size: 11px; color: #666; margin-top: 2px; }
    table { width: 100%; border-collapse: collapse; font-size: 11px; }
    thead tr { background: #f97316; color: #fff; }
    thead th { padding: 8px 6px; text-align: left; font-weight: 700; }
    tbody tr:nth-child(even) { background: #fafafa; }
    tbody tr:hover { background: #fff7ed; }
    tbody td { padding: 7px 6px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
    tfoot tr { background: #fff7ed; font-weight: 700; }
    tfoot td { padding: 8px 6px; border-top: 2px solid #f97316; }
    .badge-paid   { background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; }
    .badge-unpaid { background: #fef9c3; color: #854d0e; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; }
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .btn-print { background: #f97316; color: #fff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; margin-right: 8px; }
    .btn-back  { background: #6b7280; color: #fff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-block; }
    .action-bar { margin-bottom: 20px; padding: 12px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb; }
</style>
</head>
<body>

<!-- Tombol aksi (tidak ikut cetak) -->
<div class="action-bar no-print">
    <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
    <a href="{{ route('admin.reports.index', request()->query()) }}" class="btn-back">← Kembali</a>
    <span style="margin-left:16px;color:#6b7280;font-size:12px;">Gunakan Ctrl+P atau tombol di atas untuk mencetak / simpan sebagai PDF</span>
</div>

<!-- Header Laporan -->
<div class="header">
    <h1>TASBAGUS</h1>
    <h2>{{ strtoupper($title) }}</h2>
    <p>Jl. Raya Tas No. 123, Jakarta Selatan, DKI Jakarta 12345 | Telp: 0812-3456-7890</p>
    <p>Dicetak: {{ now()->isoFormat('dddd, DD MMMM YYYY') }} pukul {{ now()->format('H:i') }} WIB</p>
</div>

<!-- Ringkasan -->
<div class="summary">
    <div class="summary-box">
        <div class="val">{{ $orders->count() }}</div>
        <div class="lbl">Total Pesanan</div>
    </div>
    <div class="summary-box">
        <div class="val">{{ $totalItem }}</div>
        <div class="lbl">Total Item Terjual</div>
    </div>
    <div class="summary-box">
        <div class="val">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</div>
        <div class="lbl">Total Omzet</div>
    </div>
    <div class="summary-box">
        <div class="val">{{ $orders->where('payment_status','paid')->count() }}</div>
        <div class="lbl">Sudah Lunas</div>
    </div>
    <div class="summary-box">
        <div class="val">Rp {{ number_format($orders->where('payment_status','paid')->sum('total'), 0, ',', '.') }}</div>
        <div class="lbl">Omzet Lunas</div>
    </div>
</div>

<!-- Tabel Data -->
<table>
    <thead>
        <tr>
            <th style="width:4%">No</th>
            <th style="width:14%">No. Pesanan</th>
            <th style="width:11%">Tanggal</th>
            <th style="width:14%">Pelanggan</th>
            <th style="width:22%">Produk</th>
            <th style="width:10%">Metode Bayar</th>
            <th style="width:9%">Status</th>
            <th style="width:8%" class="text-right">Subtotal</th>
            <th style="width:8%" class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $i => $order)
        <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td style="font-weight:700;color:#f97316">#{{ $order->order_number }}</td>
            <td>
                {{ $order->created_at->format('d/m/Y') }}<br>
                <span style="color:#888;font-size:10px;">{{ $order->created_at->format('H:i') }} WIB</span>
            </td>
            <td>
                {{ $order->user->name ?? $order->shipping_name }}<br>
                <span style="color:#888;font-size:10px;">{{ $order->shipping_city }}</span>
            </td>
            <td>
                @foreach($order->items as $item)
                <div>{{ $item->product_name }} <span style="color:#888">(x{{ $item->quantity }})</span></div>
                @endforeach
            </td>
            <td>{{ $order->payment_method }}</td>
            <td class="text-center">
                @if($order->payment_status === 'paid')
                    <span class="badge-paid">Lunas</span>
                @else
                    <span class="badge-unpaid">Belum Bayar</span>
                @endif
            </td>
            <td class="text-right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
            <td class="text-right" style="font-weight:700">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center" style="padding:20px;color:#888;">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7" class="text-right" style="font-weight:700">TOTAL OMZET:</td>
            <td class="text-right" style="color:#f97316;font-weight:800">Rp {{ number_format($orders->sum('subtotal'), 0, ',', '.') }}</td>
            <td class="text-right" style="color:#f97316;font-weight:800">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>

<div style="margin-top:20px;text-align:right;font-size:10px;color:#888;">
    Laporan ini digenerate otomatis oleh sistem TasBagus &mdash; {{ now()->isoFormat('DD MMMM YYYY, HH:mm') }} WIB
</div>

</body>
</html>
