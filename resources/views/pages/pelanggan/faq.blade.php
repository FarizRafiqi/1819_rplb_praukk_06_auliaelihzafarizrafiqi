@extends('layouts.app')

@section('title', 'Frequently Ask Question')

@section('content')
    <div class="container mt-5">
      <h1>Pertanyaan Yang Sering Diajukan</h1>
      <div class="card">
        <div class="card-body">
          <div class="accordion mt-4" id="accordionFAQ">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left text-primary" type="button" data-toggle="collapse" data-target="#collapseOne">
                    Apa itu Listrik Pascabayar?
                  </button>
                </h2>
              </div>
          
              <div id="collapseOne" class="collapse show" data-parent="#accordionFAQ">
                <div class="card-body">
                  Listrik pascabayar adalah listrik yang pembayaran tagihannya pada akhir bulan sesuai dengan energi yang digunakan. Meteran listrik pascabayar masih menggunakan alat analog yang menunjukkan besarnya daya yang telah digunakan.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left text-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">
                    Kelebihan Listrik Pascabayar
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" data-parent="#accordionFAQ">
                <div class="card-body">
                  <ul>
                    <li>Listrik selalu tersedia sampai tenggat waktu pembayaran di akhir bulan.</li>
                    <li>Tidak repot melakukan isi ulang pulsa listrik / token listrik jika sewaktu-waktu kehabisan listrik.</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left text-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseThree">
                    Kekurangan Listrik Pascabayar
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" data-parent="#accordionFAQ">
                <div class="card-body">
                  <ul>
                    <li>Pemakaian bisa melampaui batas.</li>
                    <li>Bila ada penunggakan listrik akan terdapat denda dan bahkan dipadamkan oleh PLN.</li>
                    <li>Melanggar privasi, karena petugas PLN kerap masuk ke pekarangan rumah.</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left text-primary" type="button" data-toggle="collapse" data-target="#collapseFour">
                    Apa itu Listrik Prabayar?
                  </button>
                </h2>
              </div>
          
              <div id="collapseFour" class="collapse" data-parent="#accordionFAQ">
                <div class="card-body">
                  Listrik prabayar atau disebut juga listrik pintar adalah sistem berlangganan listrik PLN yang mengharuskan pelanggan untuk membeli token/pulsa atau voucher (listrik) terlebih dahulu sebelum bisa menggunakan energi listrik (kWh) dari PLN. Sistem ini, tidak jauh berbeda dengan saat kita membeli pulsa hp.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left text-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseFive">
                    Kelebihan Listrik Prabayar
                  </button>
                </h2>
              </div>
              <div id="collapseFive" class="collapse" data-parent="#accordionFAQ">
                <div class="card-body">
                  <ul>
                    <li>Pelanggan bisa mengontrol pemakaian listrik setiap hari.</li>
                    <li>Pemakaian listrik dapat disesuaikan dengan anggaran belanja.</li>
                    <li>Tidak akan terkena biaya keterlambatan (denda).</li>
                    <li>Tepat digunakan bagi Anda yang memiliki usaha rumah kontrakan atau kamar sewa (kos).</li>
                    <li>Tidak akan terjadi kesalahan pencatatan meteran listrik oleh petugas.</li>
                    <li>Jaringan listrik tidak akan putus  meskipun pelanggan tidak membeli pulsa listrik selama berbulan-bulan. meteran listrik prabayar juga tidak akan dibongkar meskipun pelanggan tidak  melakukan isi ulang selama lebih dari 90 hari.</li>
                    <li>Sisa pulsa listrik yang tidak habis terpakai bisa ditambah berapa saja dan kapan saja sesuai dengan kebutuhan. Sisa pulsa akan terakumulasi jika diisi ulang.</li>
                    <li>Pulsa listrik tidak memiliki masa tenggang seperti halnya pulsa seluler atau data. Oleh sebab itu, pulsa listrik yang telah diinput tidak akan hangus dan bisa terus digunakan selama berbulan-bulan  atau bahkan selama bertahun-tahun meskipun tidak diisi ulang dalam jangka waktu tertentu.</li>
                    <li>Biaya instalasi lebih murah</li>
                    <li>Privasi anda lebih terjaga karena tidak ada petugas PLN yang akan datang ke rumah-rumah pelanggan untuk mencatat penggunaan listrik sebagai dasar untuk menerbitkan rekening tagihan.</li>
                    <li>MPB akan berbunyi atau memberikan signal apabila pulsa listrik akan habis. Dengan begitu, pelanggan bisa segera melakukan isi ulang sebelum benar-benar kehabisan.Pada umumnya, MPB akan berbunyi apabila sisa KWH berada pada angka 5.</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left text-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseSix">
                    Kekurangan Listrik Prabayar
                  </button>
                </h2>
              </div>
              <div id="collapseSix" class="collapse" data-parent="#accordionFAQ">
                <div class="card-body">
                  <ul>
                    <li>Jika pulsa listrik habis di waktu yang tidak terduga Anda harus menyiapkan voucher cadangan. Bisa saja saat membutuhkan listrik, pulsa habis dan listriknya mati.</li>
                    <li>Sering bermasalah saat akan mengisi ataupun membeli, banyak kasus jaringan internet sedang down, maka Anda harus menunggu sementara listrik di rumah Anda sudah mati.</li>
                    <li>Meteran lebih sensitif dan mudah rusak.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection