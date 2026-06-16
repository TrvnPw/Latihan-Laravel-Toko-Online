@extends('backend.v_layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <form action="{{ route('backend.produk.update', $edit->id) }}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf

          <div class="card-body">
            <h4 class="card-title"> {{$judul}} </h4>
            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label>Foto</label>
                  {{-- view image: Hanya muncul jika kolom foto di database TIDAK NULL/KOSONG --}}
                  <div class="mb-2">
                    @if ($edit->foto)
                      <img src="{{ asset('storage/img-produk/' . $edit->foto) }}" class="foto-preview" width="100%">
                    @else
                      {{-- Element img ini disiapkan kosong & disembunyikan, baru muncul via javascript saat user memilih file --}}
                      <img src="" class="foto-preview" width="100%" style="display:none;">
                    @endif
                  </div>
                  
                  {{-- file foto --}}
                  <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                  @error('foto')
                  <div class="invalid-feedback alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}> - Pilih Status -</option>
                    <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Public</option>
                    <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Blok</option>
                  </select>
                  @error('status')
                  <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Kategori</label>
                  <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                    <option value="" selected> - Pilih Katagori - </option>
                    @foreach ($kategori as $row)
                    @if (old('kategori_id', $edit->kategori_id) == $row->id)
                    <option value="{{ $row->id }}" selected> {{ $row->nama_kategori }} </option>
                    @else
                    <option value="{{ $row->id }}"> {{ $row->nama_kategori }} </option>
                    @endif
                    @endforeach
                  </select>
                  @error('kategori_id')
                  <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" name="nama_produk" value="{{ old('nama_produk',$edit->nama_produk) }}" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukkan Nama Produk">
                  @error('nama_produk')
                  <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Detail</label><br>
                  <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="ckeditor">{{ old('detail',$edit->detail) }}</textarea>
                  @error('detail')
                  <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                  @enderror
                </div>

                <hr>
                <div class="form-group">
                  <label class="font-weight-bold">Detail Variasi Produk</label>

                  <div class="row mb-2 font-weight-bold text-center">
                    <div class="col-md-4">Nama Varian</div>
                    <div class="col-md-4">Harga (Rp)</div>
                    <div class="col-md-3">Stok</div>
                    <div class="col-md-1"></div>
                  </div>

                  <div id="variasi-container">
                    @foreach($edit->variasi as $v)
                    <div class="row mb-2 variasi-row">
                      <div class="col-md-4">
                        <input type="text" name="nama_variasi[]" class="form-control" value="{{ $v->nama_variasi }}" placeholder="Contoh: Ukuran M" required>
                      </div>
                      <div class="col-md-4">
                        <input type="number" name="harga_variasi[]" class="form-control" value="{{ $v->harga_variasi }}" placeholder="Contoh: 50000" required>
                      </div>
                      <div class="col-md-3">
                        <input type="number" name="stok_variasi[]" class="form-control" value="{{ $v->stok }}" placeholder="Stok" required>
                      </div>
                      <div class="col-md-1 text-center">
                        <button type="button" class="btn btn-danger btn-hapus-variasi">X</button>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <button type="button" class="btn btn-sm btn-success mt-2 btn-tambah-variasi"><i class="fas fa-plus"></i> <b>Tambah Variasi</b></button>
                </div>

              </div>

            </div>
          </div>
          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-primary">Perbaharui</button>
              <a href="{{ route('backend.produk.index') }}">
                <button type="button" class="btn btn-secondary">Kembali</button>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Tambah Baris Variasi
    document.querySelector('.btn-tambah-variasi').addEventListener('click', function() {
      let container = document.getElementById('variasi-container');
      let newRow = document.createElement('div');
      newRow.className = 'row mb-2 variasi-row';
      newRow.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="nama_variasi[]" class="form-control" placeholder="Contoh: Ukuran M" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="harga_variasi[]" class="form-control" placeholder="Contoh: 50000" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="stok_variasi[]" class="form-control" placeholder="Stok" required>
            </div>
            <div class="col-md-1 text-center">
                <button type="button" class="btn btn-danger btn-hapus-variasi">X</button>
            </div>
        `;
      container.appendChild(newRow);
    });

    // Hapus Baris Variasi
    document.getElementById('variasi-container').addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-hapus-variasi')) {
        e.target.closest('.variasi-row').remove();
      }
    });
  });
</script>
@endsection