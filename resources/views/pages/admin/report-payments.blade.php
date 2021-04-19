<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Pembayaran</title>
  <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
  <style>
    .page-break {
        page-break-after: always;
    }
    .title{
      margin-top: -100px;
    }
  </style>
</head>
<body class="bg-white">
  <nav class="navbar navbar-light">
    <span class="navbar-brand">
      <img src="{{ public_path('assets/img/megamendung-logo.png') }}" height="80px" alt="" srcset="">
    </span>
    <ul class="navbar-nav text-center">
      <li class="nav-item">
        Mega Mendung<br>
        Ujung Harapan, JL. Al-Ikhlas 14 RT 007, RW 015 <br>
        Telp : 088290051993
      </li>
    </ul>
  </nav>
  <h1 class="text-center mb-3 title">Laporan Pembayaran Listrik Pascabayar</h1>
  <p class="mb-0">
    @if ($request->action == 'print_per_date')
      Periode : {{ $request->print_per_date['tanggal_awal'] . ' sampai ' . $request->print_per_date['tanggal_akhir'] }}
    @elseif($request->action == 'today_report')
      Periode : {{ now()->format('d-m-Y') }}
    @elseif($request->action == 'this_month_report')
      Periode : {{ now()->locale('id')->monthName . ' ' . now()->year }}
    @elseif($request->action == 'last_month_report')
      Periode : {{ now()->subMonth()->locale('id')->monthName . ' ' . now()->year }}
    @endif
  </p>
  <table class="w-100 mb-3">
    <tr>
      <td>Dibuat Pada : {{ now()->format('d-m-Y') }}</td>
      <td class="text-right">Total Transaksi : {{ $payments->count() }}</td>
    </tr>
  </table>

  <table class="table table-bordered table-striped text-center">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Customer</th>
        <th>Nama Pelanggan</th>
        <th>Tanggal Bayar</th>
        <th>Biaya Admin</th>
        <th>Total Bayar</th>
        <th>Nama Petugas Bank</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($payments as $payment)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $payment->customer->nama }}</td>
          <td>{{ $payment->plnCustomer->nama_pelanggan }}</td>
          <td>{{ $payment->tanggal_bayar }}</td>
          <td>@rupiah($payment->biaya_admin)</td>
          <td>@rupiah($payment->total_bayar)</td>
          <td>{{ $payment->bank->nama ?? '-' }}</td>
          <td>{{ strtoupper($payment->status) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>