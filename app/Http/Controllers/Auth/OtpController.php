<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function verify(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'otp' => 'required|string',
        ]);

        // 2️⃣ Ambil email dari session
        $email = session('otp_email');

        if (!$email) {
            // Session email hilang → user mungkin langsung buka halaman verify
            return back()->withErrors(['otp' => 'Session OTP hilang, silakan request OTP lagi.']);
        }

        // 3️⃣ Cari user berdasarkan email session
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'User tidak ditemukan.']);
        }

        // 4️⃣ Debug friendly (aktifkan saat development)
        // dd([
        //     'email_session' => $email,
        //     'user_in_db' => $user,
        //     'otp_from_db' => $user?->otp,
        //     'otp_from_request' => $request->otp
        // ]);

        // 5️⃣ Cek apakah OTP ada di database
        if (!$user->otp) {
            return back()->withErrors(['otp' => 'Kode OTP belum dikirim atau sudah kadaluarsa.']);
        }

        // 6️⃣ Cek apakah OTP cocok
        if ($user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // 7️⃣ Cek apakah OTP masih valid
        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP kadaluarsa.']);
        }

        // 8️⃣ Login user
        Auth::login($user);

        // 9️⃣ Reset OTP di database
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        // 10️⃣ Hapus session
        session()->forget('otp_email');

        // 11️⃣ Redirect ke dashboard
        return redirect()->route('dashboard')->with('success', 'Login berhasil.');
    }
}