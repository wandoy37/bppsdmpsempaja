@extends('site.layouts.app')

@section('title', 'Berita')

@section('content')
    <section style="padding-top: 5rem; padding-bottom: 10rem;">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <h1 class="font-title-1">KONTAK KAMI</h1>
                    <p class="text-muted">
                        Unit Pelaksanaan Teknis Dinas (UPTD) Balai Penyuluhan dan Pengembangan Sumber Daya
                        Manusia Pertanian Provinsi Kalimantan Timur
                    </p>
                    <p class="text-muted">
                        <i class="fa-solid fa-location-dot"></i>
                        Jl. Thoyib Hadiwijaya No.36, Sempaja Selatan, Samarinda - Kalimantan Timur
                    </p>
                    <p class="text-muted">
                        <i class="fas fa-phone"></i>
                        (+62) 821 4872 2747
                    </p>
                </div>
                <div class="col-lg-6">
                    <form action="/" method="POST">
                        <div class="form-group">
                            <div class="mb-3">
                                <input type="text" class="form-control" style="border-radius: 25px;" name="name"
                                    placeholder="Nama Lengkap ...">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" style="border-radius: 25px;" name="phone"
                                    placeholder="Nomor Telepon ...">
                            </div>
                            <div class="mb-3">
                                <textarea name="pesan" class="form-control" style="border-radius: 25px;" rows="3" placeholder="Pesan ..."></textarea>
                            </div>
                            <div class="mb-3 float-end">
                                <button type="submit" class="btn-style-1">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
