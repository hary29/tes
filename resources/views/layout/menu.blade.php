
<nav class="navbar fixed-top navbar-expand-lg navbar-dark top-menu">
<a class="navbar-brand" href="{{ url('/') }}">
    <img src="{{ asset('img/ps-logo/ps32x90.png') }}" class="" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color:#fff"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('/') }}">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item {{ (request()->is('gallery')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/gallery') }}">Gallery</a>
        </li>
        <li class="nav-item {{ (request()->is('donation')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/donation') }}">Donation</a>
        </li>
        <!-- <li class="nav-item {{ (request()->is('contact')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
        </li> -->
        <li class="nav-item {{ (request()->is('article')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/article') }}">Article</a>
        </li>
        <li class="nav-item {{ (request()->is('about')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/about') }}">About Us</a>
        </li>
    </ul>
   
    <form class="form-inline my-2 my-lg-0" action="{{ url('/article') }}" method="GET">
      <input class="form-control mr-sm-2 transparent-input rounded-pill" name="name" type="search" placeholder="Search" aria-label="Search">
    </form>
  </div>
</nav>


