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
}
