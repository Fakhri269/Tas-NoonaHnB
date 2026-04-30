<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function printPdf(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020',
        ]);

        $month = $request->month;
        $year = $request->year;

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $monthName = $months[$month];

        // Fetch completed/paid orders for the given month and year
        // Adjust the scope here as needed (e.g., only 'completed' orders or all paid orders)
        $orders = Order::whereMonth('created_at', $month)
                       ->whereYear('created_at', $year)
                       ->orderBy('created_at', 'asc')
                       ->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('orders', 'monthName', 'year'));
        
        return $pdf->download("Laporan_Penjualan_{$monthName}_{$year}.pdf");
    }

    public function printExcel(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020',
        ]);

        $month = $request->month;
        $year = $request->year;

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $monthName = $months[$month];

        $orders = Order::whereMonth('created_at', $month)
                       ->whereYear('created_at', $year)
                       ->orderBy('created_at', 'asc')
                       ->get();

        $filename = "Laporan_Penjualan_{$monthName}_{$year}.xls";

        // Mencegah error memori dan langsung memerintahkan browser mengunduh sebagai file Excel
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Menggunakan sinkronisasi Tabel HTML ke Excel (Native, tanpa Library)
        echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        echo '<head><meta charset="UTF-8"></head>';
        echo '<body>';
        echo '<table border="1" style="font-family: Arial, sans-serif; border-collapse: collapse;">';
        
        // Header Format Rapih
        echo '<tr><th colspan="6" style="font-size: 16px; font-weight: bold; text-align:center; background-color: #f97316; color: white; padding: 10px;">LAPORAN PENJUALAN TAHUNAN & BULANAN - ' . strtoupper($monthName) . ' ' . $year . '</th></tr>';
        echo '<tr><th colspan="6" style="text-align:center; font-style: italic; background-color: #ea580c; color: white;">Tas NoonaHnB E-Commerce</th></tr>';
        
        echo '<tr style="background-color: #475569; color: white; font-weight: bold; text-align: center;">';
        echo '<th style="padding: 10px;">No</th>';
        echo '<th style="padding: 10px;">No. Pesanan</th>';
        echo '<th style="padding: 10px;">Tanggal</th>';
        echo '<th style="padding: 10px;">Nama Pelanggan</th>';
        echo '<th style="padding: 10px;">Total Pembayaran</th>';
        echo '<th style="padding: 10px;">Status</th>';
        echo '</tr>';

        $no = 1;
        $totalSum = 0;
        foreach ($orders as $order) {
            $statusMap = [
                'pending' => 'Menunggu Pembayaran',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'delivered' => 'Selesai',
                'cancelled' => 'Dibatalkan'
            ];
            $statusLabel = $statusMap[$order->status] ?? $order->status;
            
            echo '<tr>';
            echo '<td style="text-align:center; padding: 5px;">' . $no++ . '</td>';
            echo '<td style="padding: 5px;">' . $order->order_number . '</td>';
            echo '<td style="padding: 5px;">' . $order->created_at->format('d/m/Y H:i') . '</td>';
            echo '<td style="padding: 5px;">' . ($order->user ? $order->user->name : 'Guest') . '</td>';
            echo '<td style="padding: 5px;">Rp ' . number_format($order->total, 0, ',', '.') . '</td>';
            echo '<td style="text-align:center; padding: 5px;">' . $statusLabel . '</td>';
            echo '</tr>';
            
            $totalSum += $order->total;
        }

        // Summary Line
        echo '<tr>';
        echo '<th colspan="4" style="text-align:right; font-weight:bold; background-color: #e2e8f0; padding: 10px;">TOTAL PEMASUKAN </th>';
        echo '<th colspan="2" style="font-weight:bold; background-color: #e2e8f0; padding: 10px; color: #ea580c;">Rp ' . number_format($totalSum, 0, ',', '.') . '</th>';
        echo '</tr>';
        
        echo '</table>';
        echo '</body></html>';
        exit;
    }
}
