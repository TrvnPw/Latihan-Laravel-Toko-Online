@extends('frontend.v_layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <h2 class="mb-4" style="color: var(--slate-black);">Profil Saya</h2>

    <div class="card shadow-sm p-4">
      <form action="{{ route('frontend.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Bagian Foto Profil --}}
        <div class="mb-4 text-center">
          @if($user->foto)
          <img src="{{ asset('storage/img-user/' . $user->foto) }}" class="rounded-circle shadow-sm mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--digital-blue);" alt="Foto Profil">
          @else
          {{-- Kalau belum punya foto, pakai inisial nama otomatis --}}
          <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=10B981&color=fff&size=120" class="rounded-circle shadow-sm mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--digital-blue);" alt="Foto Profil">
          @endif
          <br>
          <label class="form-label fw-bold">Ganti Foto Profil</label>
          <input type="file" name="foto" class="form-control w-50 mx-auto" accept="image/jpeg, image/png, image/jpg">
          <small class="text-muted">Format: JPG/PNG, Maksimal 2MB.</small>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">No. Handphone / WA</label>
            <input type="text" name="hp" class="form-control" value="{{ old('hp', $user->hp) }}" placeholder="Contoh: 08123456789">
          </div>
        </div>

        <hr class="my-4">
        <h5 class="mb-3" style="color: var(--digital-blue);">Ubah Password <span class="text-muted" style="font-size: 14px;">(Kosongkan jika tidak ingin diubah)</span></h5>

        <div class="row mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Password Baru</label>
            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection