@extends('backend.v_layouts.app')
@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Data Banner</h4>
    <a href="{{ route('backend.banner.create') }}" class="btn btn-primary mb-3">Tambah Banner</a>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto Banner</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($banners as $row)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              <img src="{{ asset('storage/img-banner/' . $row->foto) }}" width="200" style="border-radius: 8px;">
            </td>
            <td>
              <form action="{{ route('backend.banner.destroy', $row->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger show_confirm" data-konf-delete="Banner Ini">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- ===== SCRIPT BUAT FITUR GESER/SWIPE BANNER (VERSI FINAL ANTI GAGAL) ===== --}}
<style>
  #bannerCarousel .carousel-inner {
    cursor: grab;
    touch-action: pan-y;
    /* Biar di HP tetep bisa scroll halaman ke bawah/atas */
  }

  #bannerCarousel .carousel-inner:active {
    cursor: grabbing;
  }

  /* INI KUNCI RAHASIANYA BIAR GAMBAR GAK NGE-DRAG SENDIRI */
  #bannerCarousel img {
    pointer-events: none;
    /* Bikin gambar tembus pandang dari klik mouse */
    -webkit-user-drag: none;
    /* Matiin fitur drag gambar bawaan Chrome/Safari */
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('bannerCarousel');
    if (!carousel) return;

    let startX = 0;
    let isDragging = false;

    // Kita pakai pointerdown & pointerup (Otomatis deteksi jari di HP atau Mouse di PC)
    carousel.addEventListener('pointerdown', (e) => {
      isDragging = true;
      startX = e.clientX;
      // Matiin text-selection pas lagi nge-drag pake mouse
      if (e.pointerType === 'mouse') e.preventDefault();
    });

    carousel.addEventListener('pointerup', (e) => {
      if (!isDragging) return;
      isDragging = false;
      let endX = e.clientX;
      handleSwipe(startX, endX);
    });

    // Kalau kursor keburu keluar dari area banner sebelum dilepas
    carousel.addEventListener('pointerleave', () => {
      isDragging = false;
    });

    carousel.addEventListener('pointercancel', () => {
      isDragging = false;
    });

    // Fungsi Eksekusi Geser
    function handleSwipe(start, end) {
      let threshold = 40; // Sensitivitas geser (Makin kecil makin gampang gesernya)

      if (start - end > threshold) {
        // Geser ke kiri -> Next
        document.querySelector('#bannerCarousel .carousel-control-next').click();
      } else if (end - start > threshold) {
        // Geser ke kanan -> Prev
        document.querySelector('#bannerCarousel .carousel-control-prev').click();
      }
    }
  });
</script>
@endsection