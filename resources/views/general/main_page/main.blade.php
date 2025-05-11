<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Main Page</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/general/main_page/main.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="{{ asset('js/general/main_page/main.js') }}" defer></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  {{-- HEADER --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="mt-5">
    <div class="container-fluid">
      <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-3 col-lg-2 d-none d-md-block">
          <div class="sidebar sticky-top p-3 bg-light rounded">
            <h5 class="text-center mt-3">Categories</h5>
            <ul class="nav flex-column mt-4 ps-3">
              <li class="nav-item mb-3 category-filter" data-category="Headphones"><i
                  class="fas fa-headphones fa-lg me-2"></i> Headphones</li>
              <li class="nav-item mb-3 category-filter" data-category="Sport"><i
                  class="fas fa-basketball-ball fa-lg me-2"></i> Sport</li>
              <li class="nav-item mb-3 category-filter" data-category="Gifts"><i class="fas fa-gift fa-lg me-2"></i>
                Gifts</li>
              <li class="nav-item mb-3 category-filter" data-category="Pets"><i class="fas fa-paw fa-lg me-2"></i> Pets
              </li>
              <li class="nav-item mb-3 category-filter" data-category="Cosmetics"><i
                  class="fas fa-magic fa-lg me-2"></i> Cosmetics</li>
            </ul>
          </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4">

          {{-- Carousel --}}
          <div id="productCarousel" class="carousel slide mt-2 mb-4" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow">
              <div class="carousel-item active">
                <img src="{{ asset('img/404.png') }}" class="d-block w-100" alt="Sale 1">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/Fon.png') }}" class="d-block w-100" alt="Sale 2">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('img/GveMoney.png') }}" class="d-block w-100" alt="Sale 3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>

          {{-- Products --}}
          <div class="products-wrapper bg-white p-4 rounded shadow">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mb-4">
              <div class="input-group rounded-pill border border-1 ps-3 pe-2 py-1 w-100 w-md-auto">
                <input type="text" class="form-control border-0 bg-transparent" placeholder="Search" />
                <span class="input-group-text bg-transparent border-0">
                  <i class="fas fa-search"></i>
                </span>
              </div>
              <div class="sort-buttons-grid w-100 w-md-auto">
                <button id="sort-new" type="button" class="btn btn-dark btn-sm w-100">New</button>
                <button id="sort-price-asc" type="button" class="btn btn-light btn-sm w-100 text-muted">Price
                  ascending</button>
                <button id="sort-price-desc" type="button" class="btn btn-light btn-sm w-100 text-muted">Price
                  descending</button>
              </div>
            </div>

            <div class="row" id="productsCard">
              @foreach ($products as $product)
            <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="card h-100 shadow-sm card-hover"
              onclick="window.location='{{ route('user.product.show', $product->id) }}'">
              @if ($product->images->count())
            <div id="carouselMain{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach ($product->images as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded"
            style="height: 200px; object-fit: cover;" alt="Product Image">
            </div>
          @endforeach
            </div>
            @if ($product->images->count() > 1)
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain{{ $product->id }}"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselMain{{ $product->id }}"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
          </button>
          @endif
            </div>
          @else
          <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image">
          @endif
              <div class="card-body text-center">
              <h5 class="card-title fs-6">{{ $product->name }}</h5>
              <p class="card-text text-muted small">{{ Str::limit($product->description, 50) }}</p>
              <p class="card-text text-muted mb-2 fw-bold">${{ number_format($product->price, 2) }}</p>
              <button class="btn btn-outline-dark btn-sm px-3 py-1"
                onclick="event.stopPropagation(); addToCart({{ $product->id }})">
                <i class="fas fa-cart-plus me-1"></i> <span class="d-none d-sm-inline">Add to Cart</span>
              </button>
              </div>
            </div>
            </div>
        @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function addToCart(productId) {
      alert('Product ' + productId + ' added to cart (placeholder)');
    }
  </script>
</body>

</html>