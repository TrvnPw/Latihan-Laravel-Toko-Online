<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('image/icon_zackana_store.png') }}">
    <title>Zackana Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --digital-blue: #0062FF;
            --slate-black: #0F172A;
            --alert-red: #EF4444;
            --warning-amber: #F59E0B;
            --safe-emerald: #10B981;
            --gray-10: #F8FAFC;
            --gray-50: #94A3B8;
        }

        body {
            background-color: var(--gray-10);
            color: var(--slate-black);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        h1,
        h2,
        h3,
        h4 {
            font-weight: bold;
            color: var(--slate-black);
        }

        /* Override Bootstrap Buttons */
        .btn-primary {
            background-color: var(--digital-blue);
            border-color: var(--digital-blue);
        }

        .btn-primary:hover {
            background-color: #004ee6;
            /* Blue 70 */
        }

        .btn-success {
            background-color: var(--safe-emerald);
            border-color: var(--safe-emerald);
        }

        .btn-outline-primary {
            color: var(--digital-blue);
            border-color: var(--digital-blue);
        }

        .btn-outline-primary:hover {
            background-color: var(--digital-blue);
            color: #fff;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: var(--digital-blue) !important;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">Zackana Store</a>

            <div class="d-flex align-items-center">
                @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                @else
                <a href="{{ route('frontend.profile') }}" class="btn btn-outline-primary btn-sm me-2" style="border-radius: 6px;">Profil Saya</a>
                <a href="{{ route('frontend.riwayat') }}" class="btn btn-outline-primary btn-sm me-3" style="border-radius: 6px;">Riwayat Pembelian</a>

                {{-- Foto dan Nama User di Navbar --}}
                <div class="d-flex align-items-center me-3">
                    @if(Auth::user()->foto)
                    <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="Foto" class="rounded-circle shadow-sm me-2" style="width: 35px; height: 35px; object-fit: cover;">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=10B981&color=fff" alt="Foto" class="rounded-circle shadow-sm me-2" style="width: 35px; height: 35px; object-fit: cover;">
                    @endif
                    <span style="font-weight: 500; color: var(--slate-black);">Halo, {{ explode(' ', Auth::user()->nama)[0] }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" style="background-color: var(--alert-red); border:none;">Logout</button>
                </form>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 32px; margin-bottom: 48px;">

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="alert alert-dismissible fade show shadow-sm" role="alert" style="background-color: var(--safe-emerald); color: white; border: none; border-radius: 8px;">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Notifikasi Error --}}
        @if(session('error'))
        <div class="alert alert-dismissible fade show shadow-sm" role="alert" style="background-color: var(--alert-red); color: white; border: none; border-radius: 8px;">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>