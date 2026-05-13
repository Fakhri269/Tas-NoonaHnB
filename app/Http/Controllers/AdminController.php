<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\DiscountService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        // Get filter parameters
        $fromMonth = (int) $request->get('from_month', now()->month);
        $fromYear = (int) $request->get('from_year', now()->year);
        $toMonth = (int) $request->get('to_month', now()->month);
        $toYear = (int) $request->get('to_year', now()->year);
        $productName = $request->get('product_name', '');

        // Create start and end dates from range
        $startDate = Carbon::create($fromYear, $fromMonth, 1)->startOfMonth();
        $endDate = Carbon::create($toYear, $toMonth, 1)->endOfMonth();

        // Build base query with date range
        $baseQuery = function ($query) use ($startDate, $endDate) {
            return $query->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [$startDate, $endDate]);
        };

        // Stats (without range filtering for overall)
        $totalRevenue  = (float) Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders   = Order::count();
        $totalProducts = Product::where('is_active', true)->count();
        $totalUsers    = User::where('role', 'user')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Month revenue with date range
        $monthRevenue = (float) $baseQuery(Order::query())->sum('total');

        // Daily - for display range month
        $daysInMonth = $startDate->diffInDays($endDate) + 1;
        $dailyRevenueRaw = $baseQuery(Order::query())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as revenue'))
            ->groupBy('date')->pluck('revenue', 'date');

        $dailyOrdersRaw = $baseQuery(Order::query())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'))
            ->groupBy('date')->pluck('orders', 'date');

        $dailyLabels = $dailyRevenue = $dailyOrders = [];
        $current = $startDate->copy();
        while ($current <= $endDate) {
            $dateStr = $current->format('Y-m-d');
            $dailyLabels[]  = $current->format('d');
            $dailyRevenue[] = (float) ($dailyRevenueRaw[$dateStr] ?? 0);
            $dailyOrders[]  = (int)   ($dailyOrdersRaw[$dateStr] ?? 0);
            $current->addDay();
        }

        // Monthly
        $monthlyRaw = $baseQuery(Order::query())
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy('month')->get()->keyBy('month');

        $monthNames     = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $monthlyLabels  = $monthNames;
        $monthlyRevenue = $monthlyOrders = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = (float) ($monthlyRaw[$m]->revenue ?? 0);
            $monthlyOrders[]  = (int)   ($monthlyRaw[$m]->orders  ?? 0);
        }

        // Top products - with date range and product filter
        $topProductsQuery = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', '!=', 'cancelled')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->select(
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_revenue')
            )
            ->groupBy('order_items.product_name');

        if (!empty($productName)) {
            $topProductsQuery->where('order_items.product_name', 'like', '%' . $productName . '%');
        }

        $topProducts = $topProductsQuery->orderByDesc('total_qty')->limit(5)->get();

        // Recent orders - with date range and product filter
        $recentOrdersQuery = Order::with('user')
            ->whereBetween('created_at', [$startDate, $endDate]);

        if (!empty($productName)) {
            $recentOrdersQuery->whereHas('items', function ($q) use ($productName) {
                $q->where('product_name', 'like', '%' . $productName . '%');
            });
        }

        $recentOrders = $recentOrdersQuery->latest()->take(8)->get();

        // Get all unique product names for filter
        $allProducts = DB::table('order_items')
            ->distinct()
            ->orderBy('product_name')
            ->pluck('product_name');

        $years = Order::selectRaw('YEAR(created_at) as y')
            ->groupBy('y')->orderByDesc('y')->pluck('y')->toArray();
        if (empty($years)) $years = [now()->year];

        $discountSettings = DiscountService::getSettings();

        return view('admin.dashboard', compact(
            'totalRevenue', 'totalOrders', 'totalProducts', 'totalUsers',
            'pendingOrders', 'monthRevenue',
            'dailyLabels', 'dailyRevenue', 'dailyOrders',
            'monthlyLabels', 'monthlyRevenue', 'monthlyOrders',
            'topProducts', 'recentOrders',
            'fromMonth', 'fromYear', 'toMonth', 'toYear', 'productName', 
            'years', 'daysInMonth', 'monthNames', 'allProducts',
            'discountSettings'
        ));
    }
}
