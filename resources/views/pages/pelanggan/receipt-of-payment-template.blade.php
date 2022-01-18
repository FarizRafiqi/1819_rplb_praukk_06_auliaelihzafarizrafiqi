<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Struk Pembayaran Listrik Pascabayar</title>
  <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
  <style>
    .page-break {
      page-break-after: always;
    }

    body {
      font-family: 'Courier New', Courier, monospace;
    }

    table>tr>td:first-child {
      font-weight: 800;
    }

  </style>
</head>

<body class="bg-white">
  <nav class="navbar navbar-light">
    <span class="navbar-brand">
      <img src="{{ public_path('assets/img/megamendung-logo.png') }}" height="80px" alt="" srcset="">
    </span>
  </nav>
  <h4 class="mb-3">Struk Pembayaran Tagihan Listrik</h3>
  <table class="table table-borderless">
    <tr>
      <td><b>No. Resi</b></td>
      <td>{{ $payment->id }}</td>
    </tr>
    <tr>
      <td><b>ID Pelanggan</b></td>
      <td>{{ $payment->plnCustomer->nomor_meter }}</td>
    </tr>
    <tr>
      <td><b>Nama</b></td>
      <td>{{ $payment->plnCustomer->nama_pelanggan }}</td>
    </tr>
    <tr>
      <td><b>Tarif/Daya</b></td>
      <td>{{ $payment->plnCustomer->tariff->golongan_tarif . ' / ' . $payment->plnCustomer->tariff->daya . ' VA' }}
      </td>
    </tr>
    <tr>
      <td><b>Virtual Account Number</b></td>
      <td>{{ $trx->va_numbers[0]->va_number ?? $trx->bill_key }}</td>
    </tr>
    <tr>
      <td><b>Metode Pembayaran</b></td>
      <td>{{ $payment->paymentMethod->nama ?? '-' }}</td>
    </tr>
    <tr>
      <td><b>Periode</b></td>
      <td>
        @if ($payment->details->count() > 1)
          {{ optional($payment->details->first()->bill->usage)->month_name . '-' . optional($payment->details->last()->bill->usage)->month_name . ' ' . optional($payment->details->last()->bill->usage)->tahun }}
        @else
          {{ optional($payment->details->first()->bill->usage)->month_name . ' ' . optional($payment->details->first()->bill->usage)->tahun }}
        @endif
      </td>
    </tr>
    <tr>
      <td><b>Biaya Admin</b></td>
      <td>@rupiah($payment->biaya_admin)</td>
    </tr>
    <tr>
      <td><b>Tagihan PLN</b></td>
      <td>@rupiah($payment->details->first()->total_tagihan)</td>
    </tr>
    <tr>
      <td><b>Total Bayar</b></td>
      <td>@rupiah($payment->total_bayar)</td>
    </tr>
    <tr>
      <td><b>Status</b></td>
      <td>{{ strtoupper($payment->status) }}</td>
    </tr>
  </table>
  <p>PLN menyatakan struk ini sebagai bukti pembayaran yang sah, mohon disimpan</p>
  <div class="text-center">
    <div>TERIMA KASIH</div>
    <div>INFORMASI HUB: 123</div>
  </div>
</body>

</html>
