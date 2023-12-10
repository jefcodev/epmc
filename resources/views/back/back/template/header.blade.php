<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center visible-xs visible-sm">
        <li class="dropdown">
          <a href="#main-menu" data-webarch="toggle-left-side">
            <i class="material-icons">menu</i>
          </a>
        </li>
      </ul>
      <!-- BEGIN LOGO -->
      <a href="{{ route('admin.home') }}">
        <img src="{{ asset('front/img/assets/logo-blanco.png') }}" class="logo" alt="" data-src="{{ asset('front/img/assets/logo-blanco.png') }}" data-src-retina="{{ asset('back/assets/img/logo2x.png') }}" width="106" height="21" />
      </a>
      <!-- END LOGO -->
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown hidden-xs hidden-sm">
          <a href="{{ route('admin.home') }}" class="dropdown-toggle active" data-toggle="">
            <i class="material-icons">home</i>
          </a>
        </li>
      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav">
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks">
            <a href="#" class="" id="layout-condensed-toggle">
              <i class="material-icons">menu</i>
            </a>
          </li>
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <div class="chat-toggler sm">
          <div class="profile-pic">
            <img src="{{ asset('back/assets/img/profiles/avatar_small.jpg') }}" alt="" data-src="{{ asset('back/assets/img/profiles/avatar_small.jpg') }}" data-src-retina="{{ asset('back/assets/img/profiles/avatar_small2x.jpg') }}" width="35" height="35" />
            <div class="availability-bubble online"></div>
          </div>
        </div>
        <ul class="nav quick-section ">
          <li class="quicklinks">
            <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
              <i class="material-icons">tune</i>
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
              <li>
                <a href="#"> My Account</a>
              </li>
              <li>
                <a href="#">My Calendar</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="{{ route('logout') }}"><i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log Out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>