<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\OwnerActivityLog;
use Illuminate\Http\Request;

class OwnerActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = OwnerActivityLog::with('user');

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->latest()->paginate(20)->withQueryString();

        return view('owner.activities.index', compact('activities'));
    }
}
