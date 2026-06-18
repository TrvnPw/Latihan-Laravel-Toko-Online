@extends('frontend.v_layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4 shadow-sm" style="border-radius: 12px;">
            <h3 class="text-center mb-4" style="color: var(--digital-blue);">Sign In</h3>
            
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="Masukkan email">
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Login Sekarang</button>
                
                <p class="text-center text-muted" style="font-size: 14px;">
                    Belum punya akun? <a href="{{ route('register') }}" style="color: var(--digital-blue); text-decoration: none; font-weight: bold;">Daftar di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection