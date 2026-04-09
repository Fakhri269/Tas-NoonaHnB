<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
