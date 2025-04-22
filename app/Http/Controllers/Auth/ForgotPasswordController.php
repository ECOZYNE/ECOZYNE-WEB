<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    public function handleForgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan dalam sistem kami.');
        }

        // Generate password acak 6 digit
        $newPassword = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        try {
            // Kirim email terlebih dahulu
            Mail::send('emails.new-password', ['newPassword' => $newPassword], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Reset Kata Sandi - Ecozyne');
            });

            // Jika email berhasil dikirim, baru update password di database
            $user->password = Hash::make($newPassword);
            $user->save();

            return back()->with('success', 'Password baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email reset password: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }
}
