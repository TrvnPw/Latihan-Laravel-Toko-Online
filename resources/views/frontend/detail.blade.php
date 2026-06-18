@extends('frontend.v_layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5">
        <img src="{{ asset('storage/img-produk/' . $produk->foto) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
    </div>
    <div class="col-md-7">
        <h2>{{ $produk->nama_produk }}</h2>
        <div class="mt-3">{!! $produk->detail !!}</div>

        <form action="{{ route('frontend.checkout') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="produk_id" value="{{ $produk->id }}">

            <label class="form-label fw-bold mt-2">Pilih Variasi:</label>
            <select name="variasi_id" class="form-select mb-4" required>
                @foreach($produk->variasi as $v)
                <option value="{{ $v->id }}">
                    {{ $v->nama_variasi }} - Rp {{ number_format($v->harga_variasi, 0, ',', '.') }} (Stok: {{ $v->stok }})
                </option>
                @endforeach
            </select>

            {{-- --- BAGIAN KONTAK YANG UDAH DIKELUARIN DARI KOTAK --- --}}
            <div class="mb-4">


                {{-- Input Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email_tujuan" class="form-control" placeholder="example@gmail.com" required>
                </div>

                {{-- Input No WhatsApp --}}
                <div class="mb-2">
                    <label class="form-label fw-bold">No. WhatsApp</label>
                    <div class="input-group">
                        <input type="number" name="no_hp_tujuan" class="form-control" placeholder="081234567890" required>
                    </div>
                    {{-- Ganti text-white-50 jadi text-muted biar kelihatan di background putih --}}
                    <small class="text-muted" style="font-size: 12px;">**Nomor ini akan dihubungi jika terjadi masalah</small>
                </div>

                {{-- Alert dibikin lebih soft warnanya menyesuaikan tema terang --}}
                <div class="alert alert-secondary mt-3 mb-0" role="alert" style="font-size: 14px;">
                    <i class="fas fa-info-circle me-1"></i> Pastikan isi dengan benar, bukti transaksi akan kami kirim ke email/wa yang kamu isi di atas.
                </div>
            </div>
            {{-- --- BATAS BAGIAN KONTAK --- --}}

            <button type="submit" class="btn btn-success btn-lg w-100">Proses Pembelian</button>

        </form>
    </div>
</div>
@endsection