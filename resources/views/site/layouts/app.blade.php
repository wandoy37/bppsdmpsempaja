<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPTD BPPSDMP SEMPAJA - @yield('title')</title>
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/logo.png">
    <!-- Style (Custome UPTD BPPSDMP) -->
    <link rel="stylesheet" href="{{ asset('assets') }}/style.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,300&display=swap"
        rel="stylesheet">
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/5983388006.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    @include('site.layouts.partials.navbar')

    {{-- Content Section --}}
    @yield('content')
    {{-- /Content Section --}}

    <!-- Footer -->
    <section id="footer">
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col-lg-5">
                    <a class="font-title-footer text-decoration-none text-white" href="#">
                        <img src="{{ asset('assets') }}/img/logo.png" alt="Logo" width="40"
                            class="d-inline-block align-text-top img-navbar">
                        UPTD BPPSDMP
                    </a>
                    <div class="text-brand-footer">
                        <p>Balai Penyuluhan dan Pengembangan Sumber Daya Manusia Pertanian</p>
                        <p>Jl. Thoyib Hadiwijaya No.36, Sempaja Selatan, Samarinda - Kalimantan Timur</p>
                    </div>
                </div>
                <div class="col-lg-3 ms-auto">
                    <span class="font-title-2">Kontak Kami</span>
                    <ul class="list-no-bullet" style="margin-top: 1rem;">
                        <li>(+62) 821 4872 2747</li>
                        <li>bppsdmpsempaja@gmail.com</li>
                        <li>@uptd_bppsdmpsempaja</li>
                    </ul>
                </div>
                <div class="col-lg-3 ms-auto">
                    <span class="font-title-2">Mitra Kerja</span>
                    <ul class="list-no-bullet" style="margin-top: 1rem;">
                        <li>KTNA</li>
                        <li>PETANI ANDALAN / MILENIAL</li>
                        <li>PERHIPTANI</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
</body>

</html>
