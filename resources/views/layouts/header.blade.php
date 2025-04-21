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
                <li class="nav-item"><a href="{{ url('/user/catalog') }}" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="{{ url('/user/basket') }}" class="nav-link">Basket</a></li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">log out{{--Theme--}}</a></li>
                <li class="nav-item outline-logIn"><a href="{{ url('/login') }}" class="nav-link">Log in</a></li>
                <li class="nav-item outline-logOut"><a href="{{ url('/user/registration') }}" class="nav-link">Sign In</a></li>
            </ul>
        </div>
    </div>
</nav>