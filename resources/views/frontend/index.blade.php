@extends('frontend.v_layouts.app')

@section('content')
    <h2 style="margin-bottom: 24px;">Belanja Sekarang</h2>
    
    <div class="row g-4">
        @forelse($produk as $p)
            <div class="col-md-4 col-lg-3">
                <div class="card h-100">
                    {{-- Cek apakah produk punya foto --}}
                    @if($p->foto)
                        <img src="{{ asset('storage/img-produk/' . $p->foto) }}" class="card-img-top" alt="{{ $p->nama_produk }}" style="height: 200px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background-color: var(--gray-50); color: white;">
                            <span>No Image</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title" style="font-size: 18px;">{{ $p->nama_produk }}</h4>
                        
                        {{-- Menampilkan cuplikan deskripsi (di-strip HTML tag-nya) --}}
                        <p class="card-text text-muted" style="font-size: 14px; flex-grow: 1;">
                            {{ Str::limit(strip_tags(html_entity_decode($p->detail)), 60) }}
                        </p>
                        
                        <a href="{{ route('frontend.detail', $p->id) }}" class="btn btn-primary w-100 mt-3">Beli</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center" style="padding: 48px 0;">
                <h4 style="color: var(--gray-50);">Belum ada produk yang tersedia saat ini.</h4>
            </div>
        @endforelse
    </div>
@endsection