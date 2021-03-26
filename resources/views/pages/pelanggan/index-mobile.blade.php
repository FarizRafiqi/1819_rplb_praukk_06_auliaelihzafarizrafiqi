@extends('layouts.app')

@section('title', 'MegaMendung - Semua serba bisa')

@section('content')
    
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
  <div class="container position-relative">
    <h4>
      Sudah saatnya bayar <br>
      tagihan listrik kamu..
    </h4>
    <img src="{{ asset('assets/img/icopln.png') }}" class="icon-pln" alt="ICON PLN" width="43" height="63">
    <img src="{{ asset('assets/img/ilustrasi/payment-bill-time-illustration@2x.png') }}" class="ilustrasi-payment-bill-time" alt="Payment Bill Time Illustration" width="180">
  </div>
</div>
<!-- End of Jumbotron -->

<!-- Main Content -->
<main class="container">
  @livewire('check-bill-mobile')
  <!-- End of Input ID Pelanggan -->

  <section class="postpaid-instruction mt-n4">
    <h5 class="title text-center">Bagaimana Cara Bayar Tagihan Listrik di Mega Mendung</h5>
    <div id="carouselExampleControls" class="carousel slide d-flex" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item step step-one active">
          <div class="row">
            <div class="col pr-0">
              <p class="step-one-text">
                1. Siapkan Nomor Meter atau ID Pelanggan Anda.
              </p>
            </div>
            <div class="col pl-0">
              <img src="{{ asset('assets/img/ilustrasi/ilustrasi-meteran-listrik@2x.png') }}" class="d-block ilustrasi-meteran-listrik text-right" alt="Ilustrasi Meteran Listrik">
            </div>
          </div>
        </div>
        <div class="carousel-item step step-two">
          <div class="row">
            <div class="col pr-0">
              <p class="step-one-text">
                2. Buka website Mega Mendung
                melalui desktop atau mobile.
              </p>
            </div>
            <div class="col pl-0">
              <img src="{{ asset('assets/img/ilustrasi/search-illustration@2x.png') }}" class="d-block search-illustration text-right" alt="Ilustrasi Mencari Website">
            </div>
          </div>
        </div>
        <div class="carousel-item step step-three">
          <div class="row">
            <div class="col pr-0">
              <p class="step-one-text">
              3. Kemudian masukkan nomor meter
                atau ID Pelanggan.
              </p>
            </div>
            <div class="col pl-0">
              <img src="{{ asset('assets/img/ilustrasi/ilustrasi-input-id-pelanggan@2x.png') }}" class="d-block ilustrasi-input-id-pelanggan text-right" alt="Ilustrasi Memasukkan ID Pelanggan">
            </div>
          </div>
        </div>
        <div class="carousel-item step step-four">
          <div class="row">
            <div class="col pr-0">
              <p class="step-one-text">
                4. Klik tombol <strong>Bayar</strong>.
              </p>
            </div>
            <div class="col pl-0">
              <img src="{{ asset('assets/img/ilustrasi/ilustrasi-klik-tombol-cek-tagihan@2x.png') }}" class="d-block ilustrasi-klik-tombol-cek-tagihan text-right" alt="Ilustrasi Memasukkan ID Pelanggan">
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon p-4"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon p-4"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <section class="megamendung-benefit">
    <h5 class="title text-center">
      Kenapa Lebih Baik Pakai Mega Mendung
    </h5>
    <div class="row benefit-item first-benefit align-items-center">
      <div class="col-3">
        <img src="{{asset('assets/img/mm-icon/auto-payment-icon@2x.png')}}" alt="Auto Payment Icon" width="60">
      </div>
      <div class="col-9">
        <p class="desc">
          Terdapat fitur pembayaran <br>
          tagihan otomatis
        </p>
      </div>
    </div>
    <div class="row benefit-item second-benefit align-items-center">
      <div class="col-3">
        <img src="{{asset('assets/img/mm-icon/money-icon@2x.png')}}" alt="Money Icon" width="60">
      </div>
      <div class="col-9">
        <p class="desc">
          Dapatkan cashback/bonus <br>
          tiap transaksi
        </p>
      </div>
    </div>
    <div class="row benefit-item third-benefit align-items-center">
      <div class="col-3">
        <img src="{{asset('assets/img/mm-icon/wallet-icon@2x.png')}}" alt="Wallet Icon" width="60">
      </div>
      <div class="col-9">
        <p class="desc">
          Tersedia berbagai metode <br>
          pembayaran
        </p>
      </div>
    </div>
  </section>
</main>

<!-- End of Main Content -->
@endsection
@push('addon-script')
  {{-- <script>
    $(".btn-bayar").prop("disabled", true);
    $("#inputIDPelanggan").on("keyup", delay(function(){
      let idPelanggan = $(this).val();
      $("#modalTagihan input[name='id_pelanggan']").val(idPelanggan);
      checkBill(idPelanggan);
    }, 500));

    function checkBill(idPelanggan){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url: "{{route('check-bill')}}",
        type: "post",
        dataType: "json",
        data: {id_pelanggan: idPelanggan},
        success: function(data){
            $("#btnBayar").attr("disabled", false); //aktifkan tombol bayar

            //hilangkan pesan error dan spinnernya jika data berhasil di ambil
            $('#validation-errors').children().remove();
            $("#btnBayar .spinner-border").remove();

            //Jika data tagihan ditemukan, maka cek apakah statusnya sudah terbayar atau belum
            //jika sudah terbayar maka tampilkan pesan
            if(data.userBill.bill.status == 'LUNAS'){
              $("#btnBayar").prop("disabled", true); //nonaktifkan tombol bayar
              Swal.fire({
                title: 'Tagihan Sudah Terbayar',
                icon: 'success',
                confirmButtonColor: '#3085d6',
              })
            }else{
              $('#modalTagihan').modal('show');
              $("#btnBayar").prop("disabled", false); //aktifkan tombol bayar
              //cek apakah data tagihan user ada
              if(data.userBill !== null){
                $("#namaLengkap").html(data.userBill.pln_customer.nama_pelanggan);
                $("#periode").html(data.userBill.bulan + " " + data.userBill.tahun);
                $("#jumlahPeriode").html(data.userBill.bill_count);
              }
              $("#tagihan").html(data.bill);
              $("#biayaAdmin").html(data.biayaAdmin);
              $("#total").html(data.total);
            }
        },
        error: function(xhr){
          $('#validation-errors').children().remove();
          $("#btnBayar .spinner-border").remove();
          $("#btnBayar").prop("disabled", true); //nonaktifkan tombol Bayar
          $('#modalTagihan').modal('hide');

          // if(xhr.status === 404){
          //   $('#validation-errors').html('<span class="text-danger mt-2">Tagihan tidak ditemukan!</span>').fadeIn(30);
          // }

          if(xhr.responseJSON !== undefined){
            $.each(xhr.responseJSON.errors, function(key,value) {
                $('#validation-errors').append('<span class="text-danger mt-2">'+value+'</span>').fadeIn(30);
            }); 
          }
        }
      });
    }

    function delay(callback, ms){
      let timer = 0;
      return function(){
        let context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function(){
          callback.apply(context, args);
        }, ms || 0);
      }
    } --}}
  {{-- </script> --}}
@endpush