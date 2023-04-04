<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('atlantis/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span class="text-capitalize">
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">NAVIGATION</h4>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('auth.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item {{ request()->segment(2) == 'pengguna' ? 'active' : '' }}">
                        <a href="{{ route('auth.user') }}">
                            <i class="icon-people"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ request()->segment(2) == 'kategori' ? 'active' : '' }}">
                    <a href="{{ route('auth.category') }}">
                        <i class="icon-tag"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'postingan' ? 'active' : '' }}">
                    <a href="{{ route('auth.post') }}">
                        <i class="icon-note"></i>
                        <p>Postingan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'video' ? 'active' : '' }}">
                    <a href="{{ route('auth.video') }}">
                        <i class="icon-social-youtube"></i>
                        <p>Video</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(2) == 'kegiatan' ? 'active' : '' }}">
                    <a href="{{ route('auth.activity') }}">
                        <i class="icon-support"></i>
                        <p>Kegiatan</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">CONFIGURATION</h4>
                <li class="nav-item {{ request()->segment(2) == 'sosial-media' ? 'active' : '' }}">
                    <a href="{{ route('auth.social.media') }}">
                        <i class="icon-globe"></i>
                        <p>Sosial Media</p>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon-logout text-danger"></i>
                        <p class="fw-bold text-danger">Logout</p>
                    </a>
                    <form action="{{ route('logout') }}" id="logout-form" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
