@extends('site.layouts.app')

@section('title', 'Mitra Kerja')

@push('meta')
    <meta
        content="Mitra Kerja Unit Pelaksanaan Teknis Dinas (UPTD) Balai Penyuluhan dan Pengembangan
        Sumber Daya Manusia Pertanian, bekerja sama dengan beberapa organisasi yang bersifat independen
        maupun non-independen" />
    <meta content="Mitra Kerja - UPTD BPPSDMP SEMPAJA" name="keywords" />
@endpush

@section('content')
    <section style="padding-top: 5rem;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-4">
                    <h1 class="font-title-1">MITRA KERJA UPTD BPPSDMP</h1>
                    <P class="text-muted">Mitra Kerja Unit Pelaksanaan Teknis Dinas (UPTD) Balai Penyuluhan dan Pengembangan
                        Sumber Daya Manusia Pertanian, bekerja sama dengan beberapa organisasi yang bersifat independen
                        maupun non-independen</P>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-4 text-center">
                    <img src="{{ asset('assets/img/ikamaja.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-4 text-center">
                    <img src="{{ asset('assets/img/ktna.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-4 text-center">
                    <img src="{{ asset('assets/img/p4s.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-4 text-center">
                    <img src="{{ asset('assets/img/perhiptani.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-4 text-center">
                    <img src="{{ asset('assets/img/petani-andalan-milenial.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection
