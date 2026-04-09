<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan - {{ $monthName }} {{ $year }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #f97316; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; color: #f97316; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 14px; }
        table { w-full; border-collapse: collapse; margin-top: 20px; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; color: #444; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .success { color: #16a34a; font-weight: bold; }
        .summary { margin-top: 30px; width: 300px; float: right; }
        .summary table { width: 100%; }
        .summary th { background-color: transparent; border: none; text-align: left; padding: 5px 0; }
        .summary td { border: none; text-align: right; padding: 5px 0; font-weight: bold; }
        .footer { clear: both; margin-top: 50px; text-align: center; font-size: 10px; color: #999; }
    </style>
</head>
<body>

    <div class="header">
        <h1>TasBagus - Laporan Penjualan</h1>
        <p>Periode: {{ $monthName }} {{ $year }}</p>
    </div>

    @if($orders->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">No. Pesanan</th>
                <th width="20%">Tanggal</th>
                <th width="25%">Pelanggan</th>
                <th width="15%">Metode</th>
                <th width="15%" class="text-right">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalRevenue = 0; @endphp
            @foreach($orders as $index => $order)
                @php $totalRevenue += $order->total; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $order->shipping_name }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td class="text-right">{{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <th>Total Transaksi:</th>
                <td>{{ $orders->count() }} Pesanan</td>
            </tr>
            <tr style="border-top: 2px solid #ddd;">
                <th>Total Pendapatan:</th>
                <td class="success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    @else
    <p style="text-align: center; margin-top: 50px; font-size: 16px; color: #666;">
        Tidak ada data penjualan pada periode {{ $monthName }} {{ $year }}.
    </p>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i') }} &copy; {{ date('Y') }} TasBagus</p>
    </div>

</body>
</html>
