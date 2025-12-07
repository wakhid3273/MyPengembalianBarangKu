<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     * Sesuai Flowchart: User buka aplikasi -> Tampil halaman login
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses login dengan Google OAuth (Simulasi)
     * Sesuai Flowchart:
     * 1. User klik tombol login dengan Google
     * 2. Redirect ke Google OAuth
     * 3. User pilih akun Gmail
     * 4. Email Unsoed? -> Ya/Tidak
     * 5. User authorize aplikasi
     * 6. Sistem terima token dari Google
     * 7. User sudah terdaftar? -> Ya: Load data user / Tidak: Daftarkan user baru
     * 8. Buat session user
     * 9. Redirect ke Dashboard
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Cek apakah email menggunakan domain @unsoed.ac.id
        if (!str_ends_with($request->email, '@unsoed.ac.id')) {
            return back()->with('error', '❌ Harus menggunakan Email Unsoed (@unsoed.ac.id)')->withInput();
        }

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user belum terdaftar, daftarkan otomatis (simulasi OAuth)
        if (!$user) {
            // Tentukan role berdasarkan email
            $role = 'mahasiswa'; // Default
            if (str_contains($request->email, 'admin')) {
                $role = 'admin';
            } elseif (str_contains($request->email, 'satpam')) {
                $role = 'satpam';
            }

            // Daftarkan user baru
            $user = User::create([
                'email' => $request->email,
                'name' => ucwords(str_replace('.', ' ', explode('@', $request->email)[0])),
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);

            // Login otomatis user baru
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', '✅ Akun berhasil dibuat! Selamat datang di MyPengembalianBarangKu');
        }

        // Jika user sudah terdaftar, cek password
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', '✅ Login berhasil! Selamat datang kembali, ' . $user->name);
        }

        return back()->with('error', '❌ Email atau password salah')->withInput();
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', '✅ Logout berhasil');
    }

    /**
     * Tampilkan halaman register (jika diperlukan)
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses register manual
     */
    public function register(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Cek email Unsoed
        if (!str_ends_with($request->email, '@unsoed.ac.id')) {
            return back()->with('error', '❌ Harus menggunakan Email Unsoed (@unsoed.ac.id)')->withInput();
        }

        // Tentukan role
        $role = 'mahasiswa';
        if (str_contains($request->email, 'admin')) {
            $role = 'admin';
        } elseif (str_contains($request->email, 'satpam')) {
            $role = 'satpam';
        }

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        // Auto login
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', '✅ Registrasi berhasil! Selamat datang');
    }
}