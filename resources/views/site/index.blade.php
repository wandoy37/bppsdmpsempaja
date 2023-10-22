@extends('site.layouts.app')

@section('title', 'Beranda')

@push('meta')
    <meta content="UPTD Balai Penyuluhan dan Pengembangan SDM Pertanian" name="description" />
    <meta content="UPTD BPPSDMP SEMPAJA" name="keywords" />
@endpush

@section('content')
    <!-- Hero Carousel -->
    <section>
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($beritas as $carousel)
                    <div class="carousel-item active">
                        <img src="{{ asset('/uploads/thumbnail/' . $carousel->thumbnail) }}" class="image-carousel-custom"
                            alt="...">
                        <div class="carousel-caption">
                            <div class="container mb-4 mt-4">
                                <p>{{ $carousel->title }}</p>
                                <a href="{{ route('site.berita.detail', $carousel->slug) }}"
                                    class="btn-style-1">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Content -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Tickers -->
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center breaking-news shadow">
                        <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center py-2 text-white px-1 news">
                            <span class="d-flex align-items-center">Daftar Berita</span>
                        </div>
                        <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();"
                            onmouseout="this.start();">
                            @foreach ($beritas as $tickers)
                                <span class="badge-categories">{{ $tickers->category->title }}</span>
                                <a href="{{ route('site.berita.detail', $tickers->slug) }}">{{ $tickers->title }}</a>
                            @endforeach
                        </marquee>
                    </div>
                </div>
                <!-- Cards News -->
                <div class="col-lg-9 col-news">
                    <!-- Cards -->
                    @foreach ($beritas as $berita)
                        <div class="my-4">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <img src="{{ asset('/uploads/thumbnail/' . $berita->thumbnail) }}"
                                        class="img-fluid rounded" width="400px" alt="">
                                </div>
                                <div class="col-sm-8 pt-4">
                                    <ul class="news-list-info">
                                        <li class="list-info">
                                            <span class="list-item news-category ms-3">{{ $berita->category->title }}</span>
                                        </li>
                                        <li class="list-info">
                                            <span class="list-item ms-3">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ $berita->created_at->isoFormat('D MMMM Y') }}</span>
                                        </li>
                                        <li class="list-info">
                                            <span class="list-item ms-3">
                                                <i class="fa-solid fa-user-pen"></i>
                                                {{ $berita->author->name }}</span>
                                        </li>
                                    </ul>
                                    <div class="news-content">
                                        <a href="{{ route('site.berita.detail', $berita->slug) }}"
                                            class="text-decoration-none">
                                            <span class="news-title">{{ Str::limit($berita->title, 85, '...') }}</span>
                                            <p class="news-paragraph mt-3">
                                                {{ $berita->short_content }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-3">
                    <div class="col-side">
                        <!-- Category Berita -->
                        <div class="side-title shadow mt-4">
                            <span>Kategori Berita</span>
                        </div>
                        <ol class="list-group list-group-flush my-4 shadow" style="border-radius: 20px;">
                            @foreach ($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div><a href="{{ route('site.berita.category', $category->slug) }}"
                                                class="text-decoration-none text-dark">{{ $category->title }}</a>
                                        </div>
                                    </div>
                                    <span class="badge bg-green rounded-pill">{{ $category->posts->count() }}</span>
                                </li>
                            @endforeach
                        </ol>

                        <!-- Social Media -->
                        @include('site.layouts.partials.social_media')
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- Section Applications -->
    @include('site.layouts.partials.applications')

    <!-- Section Profil Pejabat -->
    @include('site.layouts.partials.profile')
@endsection
