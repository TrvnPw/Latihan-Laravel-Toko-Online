@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Transaksi Masuk</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Seluruh Pesanan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
          <thead class="bg-light">
            <tr>
              <th>No. Invoice</th>
              <th>Tanggal</th>
              <th>Pembeli</th>
              <th>Produk & Variasi</th>
              {{-- Tambahkan Header Baru --}}
              <th>Kontak Tujuan</th>
              <th>Metode Bayar</th>
              <th>Total Harga</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($transaksi as $item)
            <tr>
              <td class="font-weight-bold">#INV-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
              <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
              <td>
                @if($item->user)
                <span class="badge bg-info text-white">{{ $item->user->nama }}</span>
                @else
                <span class="badge bg-secondary text-white">Guest</span>
                @endif
              </td>
              <td>
                <strong>{{ $item->variasi->produk->nama_produk ?? 'Dihapus' }}</strong><br>
                <small>Var: {{ $item->variasi->nama_variasi ?? '-' }}</small>
              </td>

              {{-- Tampilkan Data Nomor / ID Tujuan --}}
              <td>
                {{-- Tambahkan text-white dan p-2 --}}
                <span class="badge bg-primary text-white d-block text-start mb-1 p-2" style="font-size: 13px;">
                  <i class="fas fa-envelope"></i> {{ $item->email_tujuan ?? '-' }}
                </span>

                <span class="badge bg-success text-white d-block text-start p-2" style="font-size: 13px;">
                  <i class="fab fa-whatsapp"></i> {{ $item->no_hp_tujuan ?? '-' }}
                </span>
              </td>

              {{-- (Kolom Metode Bayar sepertinya lupa lu tampilin isinya di kode sebelumnya, gw tambahin sekalian ya) --}}
              <td>{{ strtoupper($item->metode_pembayaran) }}</td>

              <td class="text-success font-weight-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
              <td>
                @if($item->status == 'lunas')
                <span class="badge bg-success text-white">Lunas</span>
                @elseif($item->status == 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
                @else
                <span class="badge bg-danger text-white">Batal</span>
                @endif
              </td>
              {{-- Form Ubah Status --}}
              <td>
                <form action="{{ route('backend.transaksi.update_status', $item->id) }}" method="POST" class="d-flex">
                  @csrf
                  @method('PUT')
                  <select name="status" class="form-control form-control-sm mr-2" style="width: 100px;">
                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="lunas" {{ $item->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="batal" {{ $item->status == 'batal' ? 'selected' : '' }}>Batal</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9" class="text-center">Belum ada transaksi masuk.</td> {{-- Update colspan jadi 9 --}}
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection