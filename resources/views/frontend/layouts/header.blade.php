<header>
    <div class="header-area ">
        <div class="header-top_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header_top_wrap d-flex justify-content-between align-items-center">
                            <div class="text_wrap">
                                @if (Auth::user() && Auth::user()->email_verified_at !== null)
                                    <p>
                                        <i class="ti-crown"></i>
                                        <a href="{{ route('mahasiswa.daftar.member') }}">Daftar Member</a>
                                        <i class=""></i>
                                    </p>
                                @else
                                @endif
                            </div>
                            @if (Auth::guard('dosen')->user())
                                <div class="text_wrap">
                                    <p>
                                        <a href="{{ route('dosen.dashboard') }}"> <i class="ti-user"></i>  Dashboard</a> 
                                        <a href="{{ route('dosen.logout') }}">Logout</a>
                                    </p>
                                </div>
                            @elseif(Auth::guard('admin')->user())
                                <div class="text_wrap">
                                    <p>
                                        <a href="{{ route('admin.dashboard') }}"> <i class="ti-user"></i>  Dashboard</a> 
                                        <a href="{{ route('admin.logout') }}">Logout</a>
                                    </p>
                                </div>
                            @elseif(Auth::guard('asistant')->user())                                
                                <div class="text_wrap">
                                    <p>
                                        <a href="{{ route('asistant.dashboard') }}"> <i class="ti-user"></i>  Dashboard</a> 
                                        <a href="{{ route('asistant.logout') }}">Logout</a>
                                    </p>
                                </div>
                            @elseif (Auth::guard('lead')->user())                                
                                <div class="text_wrap">
                                    <p>
                                        <a href="{{ route('lead.dashboard') }}"> <i class="ti-user"></i>  Dashboard</a> 
                                        <a href="{{ route('lead.logout') }}">Logout</a>
                                    </p>
                                </div>
                            @elseif (Auth::user())
                                <div class="text_wrap">
                                    <p>
                                        <a href="{{ route('dashboard') }}"> <i class="ti-user"></i>  Dashboard</a> 
                                        <a href="{{ route('mahasiswa.logout') }}">Logout</a>
                                    </p>
                                </div>
                            @else
                                <div class="text_wrap">
                                    <p>
                                        <a href="{{ route('login') }}"> <i class="flaticon-book"></i>  Login Mahasiswa</a> 
                                        <a href="{{ route('dosen.login') }}"> <i class="ti-user"></i> Login Dosen</a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header_wrap d-flex justify-content-between align-items-center">
                            <div class="header_left">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('frontend/img/logo-depan.svg') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="header_right d-flex align-items-center">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home.schedules') }}">Jadwal</a></li>
                                            <li><a href="{{ route('home.galleries') }}">Gallery</a></li>
                                            <li><a  href="{{ route('home.release') }}">Rilis <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('home.news') }}">Berita</a></li>
                                                    <li><a href="{{ route('home.release') }}">Pengumuman</a></li>
                                                </ul>
                                            </li>
                                            <li><a  href="{{ route('home.profile') }}">Tentang Lab <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('home.profile') }}">Profil</a></li>
                                                    <li><a href="{{ route('home.structure') }}">Struktur Organisasi</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('home.tools') }}">Fasilitas<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('home.tools') }}">Peralatan Praktikum</a></li>
                                                    <li><a href="{{ route('home.tools.researchs') }}">Peralatan Penelitian</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('home.trainings') }}">Layanan <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('home.trainings') }}">Pelatihan</a></li>
                                                    <li><a href="{{ route('home.dedications') }}">Pengabdian Masyarakat</a></li>
                                                    <li><a href="{{ route('home.researchs') }}">Penelitian Dosen</a></li>
                                                    <li><a href="{{ route('home.final.task') }}">Penelitian Tugas Akhir</a></li>
                                                    <li><a href="{{ route('home.internship') }}">Penelitian Magang</a></li>
                                                    <li><a href="{{ route('home.research.individu') }}">Penelitian Lain</a></li>
                                                    <li><a href="{{ route('home.research.result') }}">Hasil Penelitian</a></li>
                                                    <li><a href="{{ route('home.practice') }}">Praktikum</a></li>
                                                    <li><a href="{{ route('home.laboratory.clearance.certificate') }}">SK Bebas Laboratorium</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('download') }}">Unduhan <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('download') }}">Unduhan</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('contact') }}">Kontak<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                                                    <li><a href="{{ route('social') }}">Media Sosial</a></li>
                                                    <li><a href="{{ route('home.faq') }}">FAQ</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>