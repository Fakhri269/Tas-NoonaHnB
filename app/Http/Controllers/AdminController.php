<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Admin check
        if (!Auth::check() || !Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $month = (int) $request->get('month', now()->month);
        $year  = (int) $request->get('year',  now()->year);

        // ── Stats ──────────────────────────────────────────────
        $totalRevenue    = (float) Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders     = Order::count();
        $totalProducts   = Product::where('is_active', true)->count();
        $totalUsers      = User::where('role', 'user')->count();
        $pendingOrders   = Order::where('status', 'pending')->count();
        $monthRevenue    = (float) Order::where('status', '!=', 'cancelled')
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->sum('total');

        // ── Daily sales for selected month ─────────────────────
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        $dailyRevenueRaw = Order::where('status', '!=', 'cancelled')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(total) as revenue'))
            ->groupBy('day')
            ->pluck('revenue', 'day');

        $dailyOrdersRaw = Order::where('status', '!=', 'cancelled')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as orders'))
            ->groupBy('day')
            ->pluck('orders', 'day');

        $dailyLabels  = [];
        $dailyRevenue = [];
        $dailyOrders  = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $dailyLabels[]  = $d;
            $dailyRevenue[] = (float) ($dailyRevenueRaw[$d] ?? 0);
            $dailyOrders[]  = (int)   ($dailyOrdersRaw[$d] ?? 0);
        }

        // ── Monthly sales for selected year ────────────────────
        $monthlyRaw = Order::where('status', '!=', 'cancelled')
            ->whereYear('created_at', $year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $monthNames     = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $monthlyLabels  = $monthNames;
        $monthlyRevenue = [];
        $monthlyOrders  = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = (float) ($monthlyRaw[$m]->revenue ?? 0);
            $monthlyOrders[]  = (int)   ($monthlyRaw[$m]->orders  ?? 0);
        }

        // ── Top products ───────────────────────────────────────
        $topProducts = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_revenue')
            )
            ->groupBy('order_items.product_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // ── Recent orders ──────────────────────────────────────
        $recentOrders = Order::with('user')->latest()->take(8)->get();

        // ── Available years ────────────────────────────────────
        $years = Order::selectRaw('YEAR(created_at) as y')
            ->groupBy('y')->orderByDesc('y')
            ->pluck('y')->toArray();
        if (empty($years)) $years = [now()->year];

        $discountSettings = DiscountService::getSettings();

        return view('admin.dashboard', compact(
            'totalRevenue', 'totalOrders', 'totalProducts', 'totalUsers',
            'pendingOrders', 'monthRevenue',
            'dailyLabels', 'dailyRevenue', 'dailyOrders',
            'monthlyLabels', 'monthlyRevenue', 'monthlyOrders',
            'topProducts', 'recentOrders',
            'month', 'year', 'years', 'daysInMonth', 'monthNames',
            'discountSettings'
        ));
    }
}
