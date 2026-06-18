@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <form class="form-horizontal" action="{{ route('backend.produk.store') }}"
          method="post" enctype="multipart/form-data">
          @csrf

          <div class="card-body">
            <h4 class="card-title"> {{$judul}} </h4>
            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label>Foto</label>
                  <img class="foto-preview">
                  <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                  @error('foto')
                  <div class="invalid-feedback alert-danger">{{ $message }}</div>
                  @enderror
                </div>

              </div>

              <div class="col-md-8">
                <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control @error('kategori') is-invalid @enderror" name="kategori_id">
                    <option value="" selected>--Pilih Kategori--
                    </option>
                    @foreach ($kategori as $k)
                    <option value="{{ $k->id }}"> {{ $k->nama_kategori }} </option>
                    @endforeach
                  </select>
                  @error('kategori_id')
                  <span class="invalid-feedback alert-danger"
                    role="alert">
                    {{ $message }}
                  </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukkan Nama Produk">
                  @error('nama_produk')
                  <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                  </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Detail</label><br>
                  <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="ckeditor">
                  {{ old('detail') }}
                  </textarea>
                  @error('detail')
                  <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                  </span>
                  @enderror
                </div>

                <div id="variasi-container">
                  <div class="row mb-2 variasi-row">
                    <div class="col-md-4">
                      <label>Nama Variasi</label>
                      <input type="text" name="nama_variasi[]" class="form-control" placeholder="Nama Variasi" required>
                    </div>
                    <div class="col-md-4">
                      <label>Harga</label>
                      <input type="text" onkeypress="return hanyaAngka(event)" name="harga_variasi[]" class="form-control" placeholder="Harga Variasi" required>
                    </div>
                    <div class="col-md-3">
                      <label>Stok</label>
                      <input type="text" onkeypress="return hanyaAngka(event)" name="stok_variasi[]" class="form-control" placeholder="Stok Variasi">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                      <button type="button" class="btn btn-success btn-tambah-variasi" style="margin-bottom: 2px;"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="border-top">
            <div class="card-body">
              <button type="submit" class="btn btn-primary">Simpan</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $(document).on('click', '.btn-tambah-variasi', function() {
      let html = `
        <div class="row mb-2 variasi-row">
          <div class="col-md-4">
            <input type="text" name="nama_variasi[]" class="form-control" placeholder="Nama Variasi" required>
          </div>
          <div class="col-md-4">
            <input type="text" onkeypress="return hanyaAngka(event)" name="harga_variasi[]" class="form-control" placeholder="Harga Variasi" required>
          </div>
          <div class="col-md-3">
            <input type="text" onkeypress="return hanyaAngka(event)" name="stok_variasi[]" class="form-control" placeholder="Stok Variasi">
          </div>
          <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-hapus-variasi" style="margin-bottom: 2px;">X</button>
          </div>
        </div>
      `;
      $('#variasi-container').append(html);
    });

    $(document).on('click', '.btn-hapus-variasi', function() {
      $(this).closest('.variasi-row').remove();
    });
  });
</script>
<!-- contentAkhir -->
@endsection