<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OwnerReportController extends Controller
{
    private function buildQuery(Request $request)
    {
        $query = Order::with(['user', 'items.product'])
            ->where('status', '!=', 'cancelled');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('order_number', 'like', "%{$s}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$s}%"))
                  ->orWhere('shipping_name', 'like', "%{$s}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('month') && $request->filled('year')) {
            $query->whereMonth('created_at', $request->month)
                  ->whereYear('created_at', $request->year);
        } elseif ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('single_date')) {
            $query->whereDate('created_at', $request->single_date);
        }

        if ($request->filled('category_id')) {
            $query->whereHas('items.product', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        return $query->latest();
    }

    public function index(Request $request)
    {
        $orders = $this->buildQuery($request)->paginate(20)->withQueryString();

        $allOrders  = $this->buildQuery($request)->get();
        $totalOrder = $allOrders->count();
        $totalOmzet = $allOrders->sum('total');
        $totalItem  = $allOrders->sum(fn($o) => $o->items->sum('quantity'));

        $categories = Category::where('is_active', true)->orderBy('name')->get();

        $years = Order::selectRaw('YEAR(created_at) as y')
            ->groupBy('y')->orderByDesc('y')->pluck('y')->toArray();
        if (empty($years)) $years = [now()->year];

        $monthNames = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember',
        ];

        return view('owner.reports.index', compact(
            'orders', 'totalOrder', 'totalOmzet', 'totalItem',
            'categories', 'years', 'monthNames'
        ));
    }

    public function exportPdf(Request $request)
    {
        $orders = $this->buildQuery($request)->get();

        $totalOmzet = $orders->sum('total');
        $totalItem  = $orders->sum(fn($o) => $o->items->sum('quantity'));

        $monthNames = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember',
        ];

        $title = $this->buildReportTitle($request, $monthNames);

        return view('admin.reports.print', compact(
            'orders', 'totalOmzet', 'totalItem', 'title', 'request'
        ));
    }

    private function buildReportTitle(Request $request, array $monthNames): string
    {
        if ($request->filled('single_date')) {
            return 'Laporan Tanggal ' . Carbon::parse($request->single_date)->isoFormat('DD MMMM YYYY');
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            return 'Laporan ' . Carbon::parse($request->date_from)->isoFormat('DD MMM YYYY')
                 . ' s/d ' . Carbon::parse($request->date_to)->isoFormat('DD MMM YYYY');
        }
        if ($request->filled('month') && $request->filled('year')) {
            return 'Laporan Bulan ' . ($monthNames[(int)$request->month] ?? '') . ' ' . $request->year;
        }
        if ($request->filled('year')) {
            return 'Laporan Tahun ' . $request->year;
        }
        return 'Laporan Semua Penjualan';
    }
}
