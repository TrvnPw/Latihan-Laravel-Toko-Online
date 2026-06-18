@extends('frontend.v_layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h3 class="mb-4">Checkout Pembelian</h3>

            <div class="mb-4">
                <h5>Produk yang dibeli:</h5>
                <p class="mb-1 fw-bold">{{ $variasi->produk->nama_produk }}</p>
                <p class="text-muted">Variasi: {{ $variasi->nama_variasi }}</p>
                <h4 style="color: var(--digital-blue);">Rp {{ number_format($variasi->harga_variasi, 0, ',', '.') }}</h4>
            </div>

            <form action="{{ route('frontend.proses_beli') }}" method="POST">
                @csrf

                {{-- Ini bawaan variasi_id dari halaman sebelumnya --}}
                <input type="hidden" name="variasi_id" value="{{ $variasi->id }}">

                {{-- TAMBAHKAN DUA BARIS INI: Tangkap Email & No HP dari halaman Detail --}}
                <input type="hidden" name="email_tujuan" value="{{ request('email_tujuan') }}">
                <input type="hidden" name="no_hp_tujuan" value="{{ request('no_hp_tujuan') }}">

                <div class="mb-4">
                    <label class="form-label fw-bold">Pilih Metode Pembayaran:</label>
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="">-- Pilih Pembayaran --</option>
                        <option value="bca">Transfer Bank BCA</option>
                        <option value="mandiri">Transfer Bank Mandiri</option>
                        <option value="gopay">GoPay</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary px-4">Bayar Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection