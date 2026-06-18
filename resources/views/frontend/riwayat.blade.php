@extends('frontend.v_layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h2 class="mb-4" style="color: var(--slate-black);">Riwayat Pembelian (Invoice)</h2>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>No. Invoice</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Metode Bayar</th>
                <th>Total Harga</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transaksi as $item)
              <tr>
                <td><strong>#INV-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                <td>
                  <span class="fw-bold">{{ $item->variasi->produk->nama_produk ?? 'Produk Dihapus' }}</span><br>
                  <small class="text-muted">Variasi: {{ $item->variasi->nama_variasi ?? '-' }}</small>
                </td>
                <td><span class="badge bg-secondary text-uppercase">{{ $item->metode_pembayaran }}</span></td>
                <td class="fw-bold" style="color: var(--digital-blue);">
                  Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                </td>
                <td>
                  @if($item->status == 'lunas')
                  <span class="badge" style="background-color: var(--safe-emerald);">Lunas</span>
                  @elseif($item->status == 'pending')
                  <span class="badge" style="background-color: var(--warning-amber);">Pending</span>
                  @else
                  <span class="badge" style="background-color: var(--alert-red);">Batal</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                  Anda belum memiliki riwayat pembelian. <br>
                  <a href="{{ route('frontend.index') }}" class="btn btn-primary btn-sm mt-2">Mulai Belanja</a>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection