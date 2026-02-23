<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // 1️⃣ Validasi email & password
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        $user = Auth::user();

        // 2️⃣ Generate OTP 6 karakter (huruf + angka)
        $otp = Str::upper(Str::random(6));

        // 3️⃣ Simpan OTP ke database (berlaku 5 menit)
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // 4️⃣ Kirim OTP ke email user
        Mail::raw("Kode OTP login kamu adalah: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Kode OTP Login');
        });

        // 5️⃣ Logout sementara (belum boleh masuk dashboard)
        Auth::logout();

        // 6️⃣ Simpan email sementara di session untuk verifikasi OTP
        session(['otp_email' => $user->email]);

        // 7️⃣ Redirect ke halaman OTP
        return redirect()->route('otp.form');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}