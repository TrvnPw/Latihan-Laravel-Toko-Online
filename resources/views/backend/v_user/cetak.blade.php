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
        <th>Email</th>
        <th>Nama</th>
        <th>Role</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cetak as $row)
      <tr>
        <td align="center"> {{ $loop->iteration }} </td>
        <td> {{$row->email}} </td>
        <td> {{$row->nama}} </td>
        <td>
          @if ($row->role == 1)
          Super Admin
          @elseif($row->role == 0)
          Admin
          @elseif($row->role == 2)
          Member Biasa
          @endif
        </td>
        <td>
          @if ($row->status == 1)
          Aktif
          @elseif($row->status == 0)
          NonAktif
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