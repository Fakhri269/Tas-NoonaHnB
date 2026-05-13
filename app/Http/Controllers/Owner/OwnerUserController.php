<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OwnerActivityLog;
use Illuminate\Http\Request;

class OwnerUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('owner.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        // Owner tidak bisa diubah role-nya
        if ($user->role === 'owner') {
            return back()->with('error', 'Role owner tidak bisa diubah.');
        }

        // Validasi: tidak boleh ada lebih dari 1 owner
        if ($request->role === 'owner') {
            return back()->with('error', 'Role owner hanya boleh 1 akun.');
        }

        $oldRole = $user->role;
        $user->update(['role' => $request->role]);

        // Catat log aktivitas
        OwnerActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'ubah_role',
            'description' => "Mengubah role {$user->name} dari '{$oldRole}' menjadi '{$request->role}'",
            'ip_address'  => $request->ip(),
        ]);

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$request->role}.");
    }

    public function destroy(Request $request, User $user)
    {
        // Owner tidak bisa dihapus
        if ($user->role === 'owner') {
            return back()->with('error', 'Akun owner tidak bisa dihapus.');
        }

        $userName = $user->name;
        $user->delete();

        // Catat log aktivitas
        OwnerActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => 'hapus_user',
            'description' => "Menghapus akun pengguna: {$userName}",
            'ip_address'  => $request->ip(),
        ]);

        return back()->with('success', "Akun {$userName} berhasil dihapus.");
    }
}
