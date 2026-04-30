<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function qris()
    {
        return view('admin.settings.qris');
    }

    public function updateQris(Request $request)
    {
        $request->validate([
            'qris_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('qris_image')) {
            // Overwrite the existing qris.png always
            $request->file('qris_image')->storeAs('settings', 'qris.png', 'public');
        }

        return redirect()->back()->with('success', 'QRIS berhasil diperbarui!');
    }

    public function discount()
    {
        $discountSettings = DiscountService::getSettings();
        return view('admin.settings.discount', compact('discountSettings'));
    }

    public function updateDiscount(Request $request)
    {
        $request->validate([
            'enabled' => 'nullable|boolean',
            'threshold' => 'required|numeric|min:0',
            'percentage' => 'required|numeric|min:0|max:100',
            'label' => 'required|string|max:100',
        ]);

        DiscountService::saveSettings([
            'enabled' => $request->boolean('enabled'),
            'threshold' => $request->threshold,
            'percentage' => $request->percentage,
            'label' => $request->label,
        ]);

        return redirect()->back()->with('success', 'Pengaturan diskon event berhasil disimpan.');
    }
}
