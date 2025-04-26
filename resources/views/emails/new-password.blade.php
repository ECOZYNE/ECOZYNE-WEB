<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Baru Anda | Ecozyne</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #334155;
            line-height: 1.6;
        }

        /* Email Container */
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 30px 0;
            text-align: center;
            color: white;
        }

        .logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 8px;
            /* Add this line */

        }

        .email-title {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            padding: 0 20px;
        }

        /* Content */
        .email-content {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #1e293b;
        }

        .instructions {
            margin-bottom: 25px;
            color: #475569;
        }

        /* Password Box */
        .password-container {
            margin: 25px 0;
            position: relative;
        }

        .password-label {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
            display: block;
        }

        .password-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 15px 25px;
            background-color: #f1f5f9;
            border-radius: 10px;
            font-size: 22px;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: 1px;
            border: 1px dashed #cbd5e1;
            position: relative;
        }

        .copy-btn {
            margin-left: 15px;
            padding: 5px 12px;
            background-color: #e2e8f0;
            border: none;
            border-radius: 6px;
            color: #334155;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background-color: #cbd5e1;
        }

        /* Action Button */
        .action-btn {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 30px;
            background-color: #10b981;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2), 0 2px 4px -1px rgba(16, 185, 129, 0.06);
        }

        .action-btn:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3), 0 4px 6px -2px rgba(16, 185, 129, 0.1);
        }

        /* Footer */
        .email-footer {
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
            border-top: 1px solid #f1f5f9;
        }

        .footer-text {
            margin: 5px 0;
        }

        /* Responsive Adjustments */
        @media only screen and (max-width: 640px) {
            .email-container {
                margin: 20px auto;
                border-radius: 0;
            }

            .email-content {
                padding: 20px;
            }

            .password-box {
                padding: 12px 20px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header with gradient background -->
        <div class="email-header">
            <img src="https://raw.githubusercontent.com/Nabil-Aditya/Ecozyne/main/public/assets2/img/ecozyne-full.png"
                alt="Ecozyne Logo" class="logo">
            <h1 class="email-title">Password Baru Anda</h1>
        </div>

        <!-- Email Content -->
        <div class="email-content">
            <p class="greeting">Halo <strong>{{ $user->name ?? 'Ecozyners' }}</strong>,</p>

            <p class="instructions">Anda telah meminta reset password. Berikut adalah password sementara untuk akun
                Anda:</p>

            <div class="password-container">
                <span class="password-label">Password Baru Anda:</span>
                <div class="password-box">
                    {{ $newPassword }}
                </div>
            </div>

            <p class="instructions">Untuk keamanan akun Anda, harap segera ganti password setelah login.</p>

            <a href="{{ $loginLink ?? '' }}" class="action-btn">Login Sekarang</a>

            <p style="font-size: 14px; color: #64748b;">Jika Anda tidak meminta reset password, abaikan email ini atau
                hubungi tim dukungan kami.</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p class="footer-text">&copy; {{ date('Y') }} Ecozyne. Semua hak dilindungi.</p>
            <p class="footer-text">Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461</p>
            <p class="footer-text">
                <a href="#" style="color: #10b981; text-decoration: none;">Bantuan</a> |
                <a href="#" style="color: #10b981; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #10b981; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
        </div>
    </div>
</body>

</html>