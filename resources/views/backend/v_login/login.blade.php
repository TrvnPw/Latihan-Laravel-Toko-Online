<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Admin Panel</title>
    <!-- Bisa ngambil font dari Google kalau mau persis banget, contoh: Inter atau Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --digital-blue: #0062FF;
            --slate-black: #0F172A;
            --gray-90: #1E293B;
            --gray-70: #475569;
            --gray-50: #94A3B8;
            --gray-30: #CBD5E1;
            --gray-10: #F8FAFC;
            --white: #FFFFFF;
            --blue-10: #E5F0FF;
            --blue-70: #004EE6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-10);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: var(--gray-90);
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 24px;
        }

        .login-card {
            background-color: var(--white);
            border: 1px solid var(--gray-30);
            border-radius: 12px;
            padding: 32px;
            /* XL Spacing */
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--slate-black);
            margin: 0 0 8px 0;
        }

        .login-header p {
            font-size: 14px;
            color: var(--gray-70);
            margin: 0;
        }

        .form-group {
            margin-bottom: 24px;
            /* L Spacing */
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-70);
            margin-bottom: 8px;
            /* S Spacing */
        }

        .form-control {
            width: 100%;
            box-sizing: border-box;
            border-radius: 8px;
            border: 1px solid var(--gray-50);
            padding: 12px 16px;
            font-size: 14px;
            color: var(--gray-90);
            background-color: var(--white);
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--digital-blue);
            box-shadow: 0 0 0 4px var(--blue-10);
            outline: none;
        }

        .btn-login {
            width: 100%;
            background-color: var(--digital-blue);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 12px 16px;
            /* SM & M Spacing */
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: var(--blue-70);
        }

        .alert-error {
            background-color: #FEF2F2;
            /* Merah super muda */
            color: #EF4444;
            /* Alert Red */
            border: 1px solid #FCA5A5;
            padding: 12px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 24px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <!-- Bisa diganti logo gambar lu -->
                <h2>Welcome Back</h2>
                <p>Silakan masuk ke akun admin Anda.</p>
            </div>

            <!-- Nampilin Error Login -->
            @if ($errors->any())
            <div class="alert-error">
                Username atau password salah.
            </div>
            @endif

            <!-- Form Login (Sesuaikan route action lu) -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="admin@zackana.com" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login">Masuk Sekarang</button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 24px; color: var(--gray-50); font-size: 12px;">
            © 2026 Toko Paling Sikma. All rights reserved.
        </div>
    </div>

</body>

</html>