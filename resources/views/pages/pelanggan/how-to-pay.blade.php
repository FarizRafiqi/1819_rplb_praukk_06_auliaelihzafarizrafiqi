@extends('layouts.app')

@section('title', 'How to Pay')

@section('content')
    <div class="container mt-5">
        <h2>Bagaimana Cara Membayar Tagihan Listrik di Megamendung?</h2>

        <div class="card mt-4 shadow">
            <div class="card-header">
                Jika Anda masih bingung bagaimana cara membayar tagihan
                listrik disini, ikuti langkah-langkah berikut untuk panduan yang lebih jelas!
            </div>
            <div class="card-body">
                {{-- Jika Anda masih bingung bagaimana cara membayar tagihan listrik disini, ikuti langkah-langkah berikut untuk
                panduan yang lebih jelas! <br><br>
                <ol>
                    <li>Siapkan nomor meter atau ID Pelanggan Anda</li>
                    <li>
                        Masukkan nomor meter atau ID Pelanggan Anda
                        <img src="{{ asset('assets/img/payment-instruction/step-1.png') }}" class="img-fluid img-thumbnail"
                            width="95%">
                    </li>
                    <li>
                        Lihat jumlah tagihan yang muncul di bawah input nomor meter
                        <img src="{{ asset('assets/img/payment-instruction/step-1.2.png') }}"
                            class="img-fluid img-thumbnail" width="95%">
                    </li>
                    <li>Klik tombol <strong>bayar</strong></li>
                    <li>Setelah itu Anda akan diarahkan ke halaman memilih metode pembayaran, <strong>pilih</strong> metode
                        pembayaran yang Anda inginkan</li>
                    <li>Ikuti instruksi pembayaran</li>
                    <li>Tekan tombol <strong>saya sudah bayar</strong></li>
                    <li>Cek status pembayaran di menu <strong>Riwayat Transaksi</strong> di atas</li>
                </ol> --}}
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-step1-tab" data-toggle="pill" href="#v-pills-step1"
                                role="tab" aria-controls="v-pills-step1" aria-selected="true">Langkah 1</a>
                            <a class="nav-link" id="v-pills-step2-tab" data-toggle="pill" href="#v-pills-step2"
                                role="tab" aria-controls="v-pills-step2" aria-selected="false">Langkah 2</a>
                            <a class="nav-link" id="v-pills-step3-tab" data-toggle="pill" href="#v-pills-step3"
                                role="tab" aria-controls="v-pills-step3" aria-selected="false">Langkah 3</a>
                            <a class="nav-link" id="v-pills-step4-tab" data-toggle="pill" href="#v-pills-step4"
                                role="tab" aria-controls="v-pills-step4" aria-selected="false">Langkah 4</a>
                            <a class="nav-link" id="v-pills-step5-tab" data-toggle="pill" href="#v-pills-step5"
                                role="tab" aria-controls="v-pills-step5" aria-selected="true">Langkah 5</a>
                            <a class="nav-link" id="v-pills-step6-tab" data-toggle="pill" href="#v-pills-step6"
                                role="tab" aria-controls="v-pills-step6" aria-selected="false">Langkah 6</a>
                            <a class="nav-link" id="v-pills-step7-tab" data-toggle="pill" href="#v-pills-step7"
                                role="tab" aria-controls="v-pills-step7" aria-selected="false">Langkah 7</a>
                            <a class="nav-link" id="v-pills-step8-tab" data-toggle="pill" href="#v-pills-step8"
                                role="tab" aria-controls="v-pills-step8" aria-selected="false">Langkah 8</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-step1" role="tabpanel"
                                aria-labelledby="v-pills-step1-tab">
                                <div>Siapkan nomor meter atau ID Pelanggan Anda.</div>
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/ilustrasi/ilustrasi-meteran-listrik@2x.png') }}"
                                        class="img-fluid" width="30%">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-step2" role="tabpanel"
                                aria-labelledby="v-pills-step2-tab">
                                Masukkan nomor meter atau ID Pelanggan
                                Anda
                                <img src="{{ asset('assets/img/payment-instruction/step-1.png') }}"
                                    class="img-fluid img-thumbnail" width="95%">
                            </div>
                            <div class="tab-pane fade" id="v-pills-step3" role="tabpanel"
                                aria-labelledby="v-pills-step3-tab">
                                Tunggu hingga info tagihan muncul. Kemudian lihat jumlah tagihan yang muncul di bawah input
                                nomor meter
                                <img src="{{ asset('assets/img/payment-instruction/step-2.png') }}"
                                    class="img-fluid img-thumbnail" width="95%">
                            </div>
                            <div class="tab-pane fade" id="v-pills-step4" role="tabpanel"
                                aria-labelledby="v-pills-step4-tab">
                                <div>Klik tombol <strong>bayar</strong></div><br>
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/ilustrasi/ilustrasi-klik-tombol-cek-tagihan@2x.png') }}"
                                        class="img-fluid" width="30%">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-step5" role="tabpanel"
                                aria-labelledby="v-pills-step5-tab">
                                <div>
                                    Setelah itu Anda akan diarahkan ke halaman memilih metode pembayaran,
                                    <strong>pilih</strong> metode pembayaran yang Anda inginkan
                                </div>
                                <img src="{{ asset('assets/img/payment-instruction/step-3.png') }}"
                                    class="img-fluid img-thumbnail" width="95%">
                            </div>
                            <div class="tab-pane fade" id="v-pills-step6" role="tabpanel"
                                aria-labelledby="v-pills-step6-tab">
                                <div>Ikuti instruksi pembayaran</div>
                                <img src="{{ asset('assets/img/payment-instruction/step-4.png') }}"
                                    class="img-fluid img-thumbnail" width="95%">
                            </div>
                            <div class="tab-pane fade" id="v-pills-step7" role="tabpanel"
                                aria-labelledby="v-pills-step7-tab">
                                <div>Tekan tombol <strong>saya sudah bayar</strong>. Jika pembayaran berhasil maka akan muncul halaman sukses.
                                </div>
                                <img src="{{ asset('assets/img/payment-instruction/step-5.png') }}"
                                    class="img-fluid img-thumbnail" width="95%">
                            </div>
                            <div class="tab-pane fade" id="v-pills-step8" role="tabpanel"
                                aria-labelledby="v-pills-step8-tab">
                                <div>Jika tidak, cek status pembayaran di menu <strong>Riwayat Transaksi</strong> di atas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
