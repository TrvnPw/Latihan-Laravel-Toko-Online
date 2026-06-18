@extends('frontend.v_layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4 shadow-sm" style="border-radius: 12px;">
            <h3 class="text-center mb-4" style="color: var(--digital-blue);">Sign Up Member</h3>
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required placeholder="Nama Anda">
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="email@contoh.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Minimal 8 karakter">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Konfirmasi Password</label>
                        {{-- Atribut name HARUS password_confirmation agar terbaca oleh validator Laravel --}}
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Daftar Akun</button>
                
                <p class="text-center text-muted" style="font-size: 14px;">
                    Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--digital-blue); text-decoration: none; font-weight: bold;">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection