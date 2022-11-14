<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <div class="d-flex sidebar-profile">
          <div class="sidebar-profile-image">
            <img src="{{ (!empty(Auth::guard('lead')->user()->profile)) ? asset(Auth::guard('lead')->user()->profile) : asset('frontend/img/user.png') }}" alt="image">
            <span class="sidebar-status-indicator"></span>
          </div>
          <div class="sidebar-profile-name">
            <p class="sidebar-name">
              {{ Auth::guard('lead')->user()->name }}
            </p>
            <p class="sidebar-designation">
              Welcome
            </p>
          </div>
        </div>
        <p class="sidebar-menu-title">Menu</p>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('lead.dashboard') }}">
          <i class="typcn typcn-device-desktop menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false" aria-controls="profile">
          <i class="typcn typcn-user-add-outline menu-icon"></i>
          <span class="menu-title">Profile</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="profile">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.profile') }}"> Edit Profile </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.profile.image') }}"> Edit Image </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.password') }}"> Password </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="typcn typcn-document menu-icon"></i>
          <span class="menu-title">Berita</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.news-category') }}"> Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.news') }}"> Daftar Berita </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#release" aria-expanded="false" aria-controls="release">
          <i class="typcn typcn-news menu-icon"></i>
          <span class="menu-title">Rilis</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="release">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.release-category') }}"> Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.release') }}"> Daftar Rilis </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#training" aria-expanded="false" aria-controls="training">
          <i class="typcn typcn-clipboard menu-icon"></i>
          <span class="menu-title">Pelatihan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="training">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.training-category') }}"> Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.training') }}"> Daftar Pelatihan </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#mahasiswa" aria-expanded="false" aria-controls="mahasiswa">
          <i class="typcn typcn-business-card menu-icon"></i>
          <span class="menu-title">Mahasiswa</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="mahasiswa">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.mahasiswa') }}"> Daftar Mahasiswa </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#dosen" aria-expanded="false" aria-controls="dosen">
          <i class="typcn typcn-group-outline menu-icon"></i>
          <span class="menu-title">Dosen</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="dosen">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.dosen') }}"> Daftar Dosen </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#gallery" aria-expanded="false" aria-controls="gallery">
          <i class="typcn typcn-image-outline menu-icon"></i>
          <span class="menu-title">Galeri</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="gallery">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.galleries') }}"> Galeri Foto</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#lab" aria-expanded="false" aria-controls="lab">
          <i class="typcn typcn-thermometer menu-icon"></i>
          <span class="menu-title">Profile Lab</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="lab">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.vission') }}"> Edit Visi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.mission') }}"> Edit Misi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.goal') }}"> Edit Tujuan </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#kontak" aria-expanded="false" aria-controls="kontak">
          <i class="typcn typcn-phone-outline menu-icon"></i>
          <span class="menu-title">Kontak</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="kontak">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.contact') }}"> Edit Kontak </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#subscribe" aria-expanded="false" aria-controls="subscribe">
          <i class="typcn typcn-arrow-sync menu-icon"></i>
          <span class="menu-title">Kustomer</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="subscribe">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('lead.customer') }}"> Semua Kustomer </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('lead.logout') }}">
          <i class="typcn typcn-power menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>
    </ul>
</nav>