<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $judul }} - Zackana Store</title>

  {{-- INI KODE BUAT NGASIH ICON BARU DI TAB BROWSER --}}
  <link rel="icon" type="image/png" href="{{ asset('image/icon_zackana_store.png') }}">

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ccc;
    }

    table tr td {
      padding: 6px;
      font-weight: normal;
      border: 1px solid #ccc;
    }

    table th {
      border: 1px solid #ccc;
      background-color: #f8fafc;
    }

    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
    }
  </style>
</head>

<body>

  <table>
    <tr>
      <td align="left">
        <strong>Perihal : {{ $judul }}</strong> <br>
        Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
      </td>
    </tr>
  </table>
  <br>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Nama Produk</th>
        <th>Nama Varian</th>
        <th>Harga</th>
        <th>Stok</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cetak as $row)
      <tr>
        <td align="center" style="vertical-align: top;"> {{ $loop->iteration }}</td>
        <td style="vertical-align: top;"> {{ $row->kategori->nama_kategori ?? '-' }} </td>
        <td style="vertical-align: top;">
          @if ($row->status == 1)
          Publis
          @elseif($row->status == 0)
          Blok
          @endif
        </td>
        <td style="vertical-align: top;"> {{ $row->nama_produk }} </td>

        <td style="vertical-align: top;">
          @if($row->variasi && $row->variasi->count() > 0)
          @foreach($row->variasi as $varian)
          • {{ $varian->nama_variasi }} <br>
          @endforeach
          @else
          -
          @endif
        </td>

        <td style="vertical-align: top;">
          @if($row->variasi && $row->variasi->count() > 0)
          @foreach($row->variasi as $varian)
          Rp. {{ number_format($varian->harga_variasi, 0, ',', '.') }} <br>
          @endforeach
          @else
          Rp. {{ number_format($row->harga, 0, ',', '.') }}
          @endif
        </td>

        <td style="vertical-align: top;">
          @if($row->variasi && $row->variasi->count() > 0)
          @foreach($row->variasi as $varian)
          {{ $varian->stok }} <br>
          @endforeach
          @else
          {{ $row->stok }}
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <script>
    window.onload = function() {
      printStruk();
    }

    function printStruk() {
      window.print();
    }
  </script>
</body>

</html>