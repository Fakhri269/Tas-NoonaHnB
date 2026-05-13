<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OwnerActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $totalUsers    = User::where('role', 'user')->count();
        $totalAdmins   = User::where('role', 'admin')->count();
        $totalProducts = Product::where('is_active', true)->count();
        $totalOrders   = Order::where('status', '!=', 'cancelled')->count();
        $totalOmzet    = (float) Order::where('status', '!=', 'cancelled')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();

        // Grafik penjualan 7 hari terakhir
        $dailyLabels = [];
        $dailyRevenue = [];
        $dailyOrders = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('d M');

            $dailyRevenue[] = (float) Order::where('status', '!=', 'cancelled')
                ->whereDate('created_at', $date)
                ->sum('total');

            $dailyOrders[] = (int) Order::where('status', '!=', 'cancelled')
                ->whereDate('created_at', $date)
                ->count();
        }

        // Grafik bulanan (12 bulan)
        $monthlyLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = (float) Order::where('status', '!=', 'cancelled')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $m)
                ->sum('total');
        }

        // Aktivitas terbaru
        $recentActivities = OwnerActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('owner.dashboard', compact(
            'totalUsers', 'totalAdmins', 'totalProducts', 'totalOrders',
            'totalOmzet', 'pendingOrders',
            'dailyLabels', 'dailyRevenue', 'dailyOrders',
            'monthlyLabels', 'monthlyRevenue',
            'recentActivities'
        ));
    }
}
