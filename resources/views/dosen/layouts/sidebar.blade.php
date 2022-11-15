<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <div class="d-flex sidebar-profile">
          <div class="sidebar-profile-image">
            <img src="{{ (!empty(Auth::guard('dosen')->user()->profile)) ? asset(Auth::guard('dosen')->user()->profile) : asset('frontend/img/user.png') }}" alt="image">
            <span class="sidebar-status-indicator"></span>
          </div>
          <div class="sidebar-profile-name">
            <p class="sidebar-name">
              {{ Auth::guard('dosen')->user()->name }}
            </p>
            <p class="sidebar-designation">
              Welcome
            </p>
          </div>
        </div>
        <p class="sidebar-menu-title">Menu</p>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.dashboard') }}">
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
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.profile') }}"> Edit Profile </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.profile.image') }}"> Edit Image </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.password') }}"> Password </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#research" aria-expanded="false" aria-controls="research">
          <i class="typcn typcn-thermometer menu-icon"></i>
          <span class="menu-title">Penelitian</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="research">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.penelitian') }}"> Penelitian </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.penelitian.joins') }}"> Penelitian Lain </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#communitydedication" aria-expanded="false" aria-controls="communitydedication">
          <i class="typcn typcn-group-outline menu-icon"></i>
          <span class="menu-title">Pengabdian</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="communitydedication">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.community.dedication') }}"> Pengabdian Masyarakat </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('dosen.community.dedication.joins') }}"> Pengabdian Masyarakat Lain </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.logout') }}">
          <i class="typcn typcn-power menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>
    </ul>
</nav>