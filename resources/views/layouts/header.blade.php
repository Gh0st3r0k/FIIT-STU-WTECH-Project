<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <a href="{{ url('/main-page') }}" class="navbar-brand">
      <img src="{{ asset('img/logo.png') }}" alt="Icone" width="35" height="35">
      <span class="navbar-title ms-3">InfyGo</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto">

        @auth
          @php $isAdmin = Auth::user()->role === 'admin'; @endphp

          {{-- Products --}}
          <li class="nav-item">
            <a href="{{ url($isAdmin ? '/admin/catalog' : '/user/catalog') }}"
              class="nav-link {{ request()->is($isAdmin ? 'admin/catalog' : 'user/catalog') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Products
            </a>
          </li>

          {{-- Contact --}}
          <li class="nav-item">
            <a href="{{ url('/contact') }}"
              class="nav-link {{ request()->is('contact') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Contact
            </a>
          </li>

          {{-- Basket --}}
          <li class="nav-item">
            <a href="{{ url($isAdmin ? '/admin/orders' : '/user/basket') }}"
              class="nav-link {{ request()->is($isAdmin ? 'admin/basket' : 'user/basket') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Basket
            </a>
          </li>

          {{-- Admin-only --}}
          @if ($isAdmin)
            <li class="nav-item">
              <a href="{{ route('register.admin.form') }}"
                class="nav-link {{ request()->is('admin/registration') ? 'border-bottom border-2 border-primary fw-bold text-primary' : 'text-primary' }}">
                Add Admin
              </a>
            </li>
          @endif

          {{-- Logout --}}
          <li class="nav-item outline-logOut">
            <a href="{{ route('logout') }}" class="nav-link text-danger">Log out</a>
          </li>
        @else
          {{-- Guest --}}
          <li class="nav-item">
            <a href="{{ url('/user/catalog') }}"
              class="nav-link {{ request()->is('user/catalog') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Products
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/contact') }}"
              class="nav-link {{ request()->is('contact') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Contact
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/user/basket') }}"
              class="nav-link {{ request()->is('user/basket') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Basket
            </a>
          </li>
          <li class="nav-item outline-logIn">
            <a href="{{ url('/login') }}"
              class="nav-link {{ request()->is('login') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Log in
            </a>
          </li>
          <li class="nav-item outline-logOut">
            <a href="{{ url('/user/registration') }}"
              class="nav-link {{ request()->is('user/registration') ? 'border-bottom border-2 border-primary fw-bold' : '' }}">
              Sign In
            </a>
          </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>
