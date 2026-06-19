@extends('backend.v_layouts.app')
@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Banner Baru</h4>
    <form action="{{ route('backend.banner.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group mb-3">
        <label>Foto Banner (Maks. 2MB)</label>
        <input type="file" name="foto" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('backend.banner.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection