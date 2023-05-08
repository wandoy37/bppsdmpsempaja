@extends('site.layouts.app')

@section('title', 'Tentang Kami')

@section('content')
    <section style="padding-top: 5rem;">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <h1 class="font-title-1">UPTD BPPSDMP SEMPAJA</h1>
                    <p class="text-muted">Hi, berikut gambaran umum terkait instansi UPTD Balai Penyuluhan dan Pengembangan
                        Sumber Daya Manusia Pertanian Sempaja, Samarinda - Kalimantan Timur</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/img/gedung-2.jpeg') }}" class="img-fluid rounded" alt="">
                </div>
                <div class="col-lg-6" style="text-align: justify;">
                    <p class="text-muted my-4">UPTD BPPSDMP Sempaja Samarinda Provinsi Kalimantan Timur adalah organisasi
                        pemerintahan yang bergerak pada bidang kegiatan teknis operasional dan pelatihan pertanian.</p>
                    <p class="text-muted my-4">Dibawah naungan Dinas Pangan Tanaman Pangan dan Hortikultura, Demi menunjang
                        sektor pertanian hortikultura UPTD BPPSDMP bergerak sebagai unit kerja yang menjalankan
                        kegiatan-kegiatan teknis seputar pertanian, dan pelatihan non-teknis (akademi pertanian) maupun
                        teknis.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-muted">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-4">
                    <h1 class="font-title-1">SEJARAH INSTANSI</h1>
                    <P class="text-muted">Hi, berikut sejarah singkat UPTD Balai Penyuluhan dan Pengembangan Sumber Daya
                        Pertanian Sempaja, Samarinda - Kalimantan Timur</P>
                </div>
                <div class="col-lg-6">
                    <p>UNIT PELAKSANA TEKNIS DINAS (UPTD) BPPSDMP Sempaja Samarinda Provinsi Kalimantan Timur.</p>
                    <p>Balai Penyuluhan dan Pengembangan SDM Pertanian Provinsi Kalimantan Timur dibangun pada tahun 1985,
                        selesai dibangun pada tahun 1988, dan di resmikan pada tanggal 13 Januari 1988, oleh Menteri
                        Pertanian.</p>
                    <p>Bapak Ir. Achmad Affandi, dalam perjalanannya UPTD Balai Penyuluhan dan Pengembangan SDM Pertanian
                        Sempaja Provinsi Kalimantan Timur mengalami 4 (empat) kali perubahan nama, yaitu :</p>
                    <ol>
                        <li>Tahun 1985 s.d. tahun 2004 dengan Nama BALAI LATIHAN PEGAWAI PERTANIAN (BLPP)</li>
                        <li>Tahun 2004 s.d. Tahun 2009 dengan Nama (UPTD) BALAI PELATIHAN TEKNIS PERTANIAN (BPTP)</li>
                        <li>Tahun 2009 s.d. Tahun 2016 berganti Nama dengan (UPTB) BALAI PELATIHAN PERTANIAN (BAPELTAN)</li>
                        <li>Tahun 2017 s.d. Sekarang berganti nama dengan (UPTD) BALAI PENYULUHAN DAN PENGEMBANGAN SDM
                            PERTANIAN (BPPSDMP) Sempaja Provinsi Kalimantan Timur</li>
                    </ol>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/img/gedung-1.jpg') }}" class="img-fluid rounded" alt="">
                </div>
            </div>
        </div>
    </section>

    @include('site.layouts.partials.profile')

@endsection
