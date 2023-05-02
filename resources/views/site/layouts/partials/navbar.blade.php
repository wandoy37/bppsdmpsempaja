<section>
    <nav class="navbar navbar-expand-lg navbar-dark nav-bg-green">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets') }}/img/logo.png" alt="Logo" width="40"
                    class="d-inline-block align-text-top img-navbar">
                UPTD BPPSDMP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4">
                        <a class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}"
                            href="{{ route('site.index') }}">Beranda</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="/bppsdmsempaja/profile.php">Profil</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link {{ request()->segment(1) == 'berita' ? 'active' : '' }}"
                            href="{{ route('site.berita') }}">Berita</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="/bppsdmsempaja/mitrakerja.php">Mitra Kerja</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="/bppsdmsempaja/kontak.php">Kontak</a>
                    </li>
                    <form action="/bppsdmsempaja" class="d-flex" role="search">
                        <input class="form-control me-2 input-custom" name="search" type="search"
                            placeholder="Pencarian...">
                    </form>
                </ul>
            </div>
        </div>
    </nav>
</section>
