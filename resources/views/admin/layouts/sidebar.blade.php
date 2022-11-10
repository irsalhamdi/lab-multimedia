<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <div class="d-flex sidebar-profile">
          <div class="sidebar-profile-image">
            <img src=" {{ (!empty(Auth::guard('admin')->user()->profile)) ? asset(Auth::guard('admin')->user()->profile) : asset('frontend/img/user.png') }}" alt="image">
            <span class="sidebar-status-indicator"></span>
          </div>
          <div class="sidebar-profile-name">
            <p class="sidebar-name">
              {{ Auth::guard('admin')->user()->name }}
            </p>
            <p class="sidebar-designation">
              Welcome
            </p>
          </div>
        </div>
        <p class="sidebar-menu-title">Menu</p>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.profile') }}"> Edit Profile </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.profile.image') }}"> Edit Image </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.password') }}"> Password </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#news" aria-expanded="false" aria-controls="news">
          <i class="typcn typcn-document menu-icon"></i>
          <span class="menu-title">Berita</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="news">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.news-category') }}"> Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.news') }}"> Daftar Berita </a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.release-category') }}"> Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.release') }}"> Daftar Rilis </a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.training-category') }}"> Kategori </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.training') }}"> Daftar Pelatihan </a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.mahasiswa') }}"> Daftar Mahasiswa </a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.dosen') }}"> Daftar Dosen </a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.vission') }}"> Edit Visi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.mission') }}"> Edit Misi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.goal') }}"> Edit Tujuan </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tool" aria-expanded="false" aria-controls="tool">
          <i class="typcn typcn-flash-outline menu-icon"></i>
          <span class="menu-title">Peralatan Lab</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tool">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.tools') }}"> Peralatan</a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.contact') }}"> Edit Kontak </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#qa" aria-expanded="false" aria-controls="qa">
          <i class="typcn typcn-message-typing menu-icon"></i>
          <span class="menu-title">Pesan</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="qa">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.message') }}"> Semua Pesan </a></li>
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.customer') }}"> Semua Kustomer </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}">
          <i class="typcn typcn-power menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>
    </ul>
</nav>