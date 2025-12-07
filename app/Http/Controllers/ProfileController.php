<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil user
     */
    public function show()
    {
        $user = Auth::user();
        // Load items dengan kategori, diurutkan dari yang terbaru
        $items = $user->items()->with('category')->orderBy('created_at', 'desc')->get();
        
        return view('profile.show', compact('user', 'items'));
    }

    /**
     * Update profil user
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'angkatan' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'nim.max' => 'NIM maksimal 20 karakter',
            'angkatan.max' => 'Angkatan maksimal 10 karakter',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
        ]);

        // Update profil
        $user->update([
            'name' => $validated['name'],
            'nim' => $validated['nim'] ?? null,
            'angkatan' => $validated['angkatan'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        return redirect()->route('profile.show')
            ->with('success', '✅ Profil berhasil diperbarui!');
    }
}
