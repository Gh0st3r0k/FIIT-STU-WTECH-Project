<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Catalog</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/general/catalog/user-catalog.css') }}" />
  <script src="{{ asset('js/general/catalog/user-catalog.js') }}" defer></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

  {{-- HEADER --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="mt-5">
    <div class="container-fluid">

      {{-- Заголовок каталога --}}
      <div class="catalog-name bg-white p-2 w-100 rounded shadow mb-2 mt-1">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Home / Catalog</small>
            <h2 class="fw-bold mt-1">Product Catalog</h2>
          </div>
          <a href="{{ url('/user/profile') }}" class="d-flex align-items-center text-decoration-none text-dark mt-3 mt-md-0">
            @php $user = session('user') ?? ['name' => 'Guest', 'surname' => '']; @endphp
            <span class="me-2 fs-5">{{ $user['name'] }} {{ $user['surname'] }}</span>
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </a>
        </div>
      </div>

      <div class="row">
        {{-- SIDEBAR --}}
        <div class="col-md-3 col-lg-2 d-none d-md-block">
          <div class="sidebar sticky-top p-3 bg-light rounded">
            <h5 class="text-center mt-3">Categories</h5>
            <ul class="nav flex-column mt-4 ps-3">
              <li class="nav-item mb-3 category-filter" data-category="Headphones"><i class="fas fa-headphones fa-lg me-2"></i> Headphones</li>
              <li class="nav-item mb-3 category-filter" data-category="Sport"><i class="fas fa-basketball-ball fa-lg me-2"></i> Sport</li>
              <li class="nav-item mb-3 category-filter" data-category="Gifts"><i class="fas fa-gift fa-lg me-2"></i> Gifts</li>
              <li class="nav-item mb-3 category-filter" data-category="Pets"><i class="fas fa-paw fa-lg me-2"></i> Pets</li>
              <li class="nav-item mb-3 category-filter" data-category="Cosmetics"><i class="fas fa-magic fa-lg me-2"></i> Cosmetics</li>
            </ul>
          </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4">

          {{-- Mobile Sidebar Toggle --}}
          <button class="btn btn-category-toggle d-md-none my-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCategories">
            ☰ Categories
          </button>

          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCategories">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title">Categories</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <h5 class="text-center mt-3">Popular categories</h5>
              <ul class="nav flex-column mt-4 ps-3">
                <li class="nav-item mb-3 category-filter" data-category="Headphones"><i class="fas fa-headphones fa-lg me-2"></i> Headphones</li>
                <li class="nav-item mb-3 category-filter" data-category="Sport"><i class="fas fa-basketball-ball fa-lg me-2"></i> Sport</li>
                <li class="nav-item mb-3 category-filter" data-category="Gifts"><i class="fas fa-gift fa-lg me-2"></i> Gifts</li>
                <li class="nav-item mb-3 category-filter" data-category="Pets"><i class="fas fa-paw fa-lg me-2"></i> Pets</li>
                <li class="nav-item mb-3 category-filter" data-category="Cosmetics"><i class="fas fa-magic fa-lg me-2"></i> Cosmetics</li>
              </ul>
            </div>
          </div>

          {{-- Filters + Products --}}
          <div class="products-wrapper bg-white p-4 rounded shadow">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mb-4">

              {{-- Search --}}
              <div class="input-group rounded-pill border border-1 ps-3 pe-2 py-1 w-100 w-md-auto" id="searchInput">
                <input type="text" class="form-control border-0 bg-transparent" placeholder="Search" />
                <span class="input-group-text bg-transparent border-0">
                  <i class="fas fa-search"></i>
                </span>
              </div>

              {{-- Sort --}}
              <div class="sort-buttons-grid w-100 w-md-auto">
                <button id="sort-new" type="button" class="btn btn-dark btn-sm w-100">New</button>
                <button id="sort-price-asc" type="button" class="btn btn-light btn-sm w-100 text-muted">Price ascending</button>
                <button id="sort-price-desc" type="button" class="btn btn-light btn-sm w-100 text-muted">Price descending</button>
                <button id="sort-rating" type="button" class="btn btn-light btn-sm w-100 text-muted">Rating</button>
              </div>
            </div>

            {{-- Products --}}
            <div class="row" id="productsCard">
              {{-- JS will fill cards here --}}
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
