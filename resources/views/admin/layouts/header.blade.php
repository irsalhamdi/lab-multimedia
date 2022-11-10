<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="{{ route('home') }}"><img src="{{ asset('backend/images/logo-belakang.svg') }}" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('backend/images/logo-mini.svg') }}" alt="logo"/></a>
      <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
        <span class="typcn typcn-th-menu"></span>
      </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown d-flex">
          <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
            <i class="typcn typcn-message-typing"></i>
            @php
              $messages = App\Models\Message::latest()->get();
            @endphp
            <span class="count bg-success">{{ $messages->count() }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
            @foreach ($messages as $message)
              <a href="{{ route('admin.message') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{ ($message->user->profile != null) ? asset($message->user->profile) : asset('frontend/img/user.png') }}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">
                      {{ Str::limit($message->user->name, 10) }}
                    </h6>
                    <p class="font-weight-light small-text mb-0">
                      {{ Str::limit($message->excerpt, 10) }}
                    </p>
                  </div>
              </a>
            @endforeach
          </div>
        </li>
        <li class="nav-item dropdown  d-flex">
          <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="typcn typcn-bell mr-0"></i>
            @php
              $customers = App\Models\Customers::latest()->get();
            @endphp
            <span class="count bg-danger">{{ $customers->count() }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
            @foreach ($customers as $customer)
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="typcn typcn-info-large mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">{{ $customer->email }}</h6>
                  <p class="font-weight-light small-text mb-0">
                    Kustomer Baru
                  </p>
                </div>
              </a>
            @endforeach
          </div>
        </li>
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
            <i class="typcn typcn-user-outline mr-0"></i>
            <span class="nav-profile-name">{{ Auth::guard('admin')->user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a href="{{ route('admin.logout') }}" class="dropdown-item">
            <i class="typcn typcn-power text-primary"></i>
            Logout
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="typcn typcn-th-menu"></span>
      </button>
    </div>
</nav>