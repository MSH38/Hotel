<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Deluxe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="rooms" class="nav-link">Rooms</a></li>
            <li class="nav-item"><a href="restaurant" class="nav-link">Restaurant</a></li>
            <li class="nav-item"><a href="about-us" class="nav-link">About</a></li>
            <li class="nav-item"><a href="contact" class="nav-link">Contact</a></li>


        </ul>
        <div>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="login" class="nav-link">Login / Register</a></li>
          </ul>
        </div>
        </div>
        <div class="dropdown main-profile-menu nav nav-item nav-link">
          <a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></a>
          <div class="dropdown-menu">
            <div class="main-header-profile bg-primary p-3">
              <div class="d-flex wd-100p">
                <div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}" class=""></div>
                  <div class="mr-3 my-auto">
                  </div>
                </div>
              </div>
              <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
              <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
              <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
              <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
              <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
              <!-- <a class="dropdown-item" href="{{ url('/' . $page='page-signin') }}"><i class="bx bx-log-out"></i> Sign Out</a> -->
              <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bx bx-log-out"></i>تسجيل خروج</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form>
            </div>
          </div>
        </div>
    </div>
</nav>
<!-- <section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image:url(images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-12 ftco-animate text-center">
        <div class="text mb-5 pb-3">
          <h1 class="mb-3">Welcome To Deluxe</h1>
          <h2>Hotels &amp; Resorts</h2>
        </div>
      </div>
    </div>
    </div>
  </div>

  <div class="slider-item" style="background-image:url(images/bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-12 ftco-animate text-center">
        <div class="text mb-5 pb-3">
          <h1 class="mb-3">Enjoy A Luxury Experience</h1>
          <h2>Join With Us</h2>
        </div>
      </div>
    </div>
    </div>
  </div>
</section> -->