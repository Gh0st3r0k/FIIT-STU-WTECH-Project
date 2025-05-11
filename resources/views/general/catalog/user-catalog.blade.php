<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Catalog</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/general/catalog/user-catalog.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="{{ asset('js/general/catalog/user-catalog.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .card-hover {
      cursor: pointer;
      transition: box-shadow 0.2s;
    }

    .card-hover:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body>
  <header>@include('layouts.header')</header>

  <section id="main-content" class="mt-0">
    <div class="container">
      <div class="catalog-name bg-white p-2 w-100 rounded shadow mb-2 mt-1">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted" id="catalog-path">Home / Catalog</small>
            <h2 class="fw-bold mt-1">Product Catalog</h2>
          </div>
          <a href="{{ url('/user/profile') }}"
            class="d-flex align-items-center text-decoration-none text-dark mt-3 mt-md-0">
            @auth
              <span class="me-2 fs-5">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
            @else
              <span class="me-2 fs-5 text-muted">Guest</span>
            @endauth
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </a>
        </div>
      </div>

      <div class="bg-white rounded shadow p-4">
        <div class="row">
          <!-- ФИЛЬТРЫ -->
          <div class="col-lg-3 mb-4">
            <form id="filterForm" method="GET" action="{{ route('catalog') }}">
              <div class="mb-3">
                <label class="form-label fw-bold">Price:</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control mb-2" placeholder="from">
                <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control" placeholder="to">
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Categories:</label>
                @foreach ($categories as $cat)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="type[]" value="{{ $cat->id }}"
                      {{ in_array($cat->id, (array) request('type')) ? 'checked' : '' }}>
                    <label class="form-check-label">
                      {{ $cat->name }}
                    </label>
                  </div>
                @endforeach
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="is_new" value="1"
                    {{ request('is_new') ? 'checked' : '' }}>
                  <label class="form-check-label fw-bold">
                    Only new (5 days)
                  </label>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100">Filter</button>
            </form>
          </div>

          <!-- КАТАЛОГ -->
          <div class="col-lg-9">
            <div class="bg-white p-3 rounded d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 mb-4">
              <div class="input-group rounded-pill border border-1 ps-3 pe-2 py-1 w-100 w-md-auto" id="searchInput">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0 bg-transparent" placeholder="Search by name..." form="filterForm" />
                <span class="input-group-text bg-transparent border-0">
                  <i class="fas fa-search"></i>
                </span>
              </div>

              <div class="sort-buttons-grid w-100 w-md-auto">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'desc']) }}"
                  class="btn btn-sm w-100 {{ request('sort') === 'created_at' ? 'btn-dark' : 'btn-light text-muted' }}">
                  New
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}"
                  class="btn btn-sm w-100 {{ request('sort') === 'price' && request('direction') === 'asc' ? 'btn-dark' : 'btn-light text-muted' }}">
                  Price ascending
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}"
                  class="btn btn-sm w-100 {{ request('sort') === 'price' && request('direction') === 'desc' ? 'btn-dark' : 'btn-light text-muted' }}">
                  Price descending
                </a>
              </div>
            </div>

        <div class="row" id="productsCard">
          @forelse ($products as $product)
            <div class="col-6 col-sm-4 col-md-4 mb-4">
              <div class="card h-100 shadow-sm card-hover"
                onclick="window.location='{{ route('user.product.show', $product->id) }}'">
                @if ($product->images->count())
                  <div id="carouselUser{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      @foreach ($product->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                          <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded"
                            style="height: 200px; object-fit: cover;" alt="Product Image">
                        </div>
                      @endforeach
                    </div>
                    @if ($product->images->count() > 1)
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselUser{{ $product->id }}"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselUser{{ $product->id }}"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    @endif
                  </div>
                @else
                  <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image">
                @endif
                <div class="card-body text-center">
                  <h5 class="card-title fs-6">{{ $product->name }}</h5>
                  <p class="card-text text-muted mb-2">${{ number_format($product->price, 2) }}</p>
                  <button class="btn btn-outline-primary btn-sm px-3 py-1"
                    onclick="event.stopPropagation(); addToCart({{ $product->id }})">
                    <i class="fas fa-cart-plus me-1"></i> Add to Cart
                  </button>
                </div>
              </div>
            </div>
          @empty
            <p class="text-muted">There are no items matching the filters.</p>
          @endforelse
        </div>

{{-- ПАГИНАЦИЯ --}}
@if ($products->hasPages())
  <div class="mt-4 d-flex justify-content-center">
    {{ $products->appends(request()->except('page'))->links() }}
  </div>
@endif


            <!-- <div class="row" id="productsCard">
              @forelse ($products as $product)
                <div class="col-6 col-sm-4 col-md-4 mb-4">
                  <div class="card h-100 shadow-sm card-hover"
                    data-product-id="{{ $product->id }}"
                    onclick="window.location='{{ route('user.product.show', $product->id) }}'">
                    @if ($product->images->count())
                      <div id="carouselUser{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                              <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded"
                                style="height: 200px; object-fit: cover;" alt="Product Image">
                            </div>
                          @endforeach
                        </div>
                        @if ($product->images->count() > 1)
                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselUser{{ $product->id }}"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselUser{{ $product->id }}"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                        @endif
                      </div>
                    @else
                      <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body text-center">
                      <h5 class="card-title fs-6">{{ $product->name }}</h5>
                      <p class="card-text text-muted mb-2">${{ number_format($product->price, 2) }}</p>
                      <button class="btn btn-outline-primary btn-sm px-3 py-1"
                        onclick="event.stopPropagation(); addToCart({{ $product->id }})">
                        <i class="fas fa-cart-plus me-1"></i> Add to Cart
                      </button>
                    </div>
                  </div>
                </div>
              @empty
                <p class="text-muted">There are no items matching the filters.</p>
              @endforelse
            </div> -->

            <div class="mt-5">
              <h4 class="fw-bold mb-4">You may also like</h4>
              <div class="row">
                @foreach ($recommended as $rec)
                  <div class="col-6 col-md-3 mb-4">
                    <div class="card h-100 shadow-sm card-hover"
                      onclick="window.location='{{ route('user.product.show', $rec->id) }}'">
                      @if ($rec->images->count())
                        <img src="{{ asset('storage/' . $rec->images->first()->path) }}" class="card-img-top"
                          style="height: 180px; object-fit: cover;" alt="Recommended">
                      @else
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image">
                      @endif
                      <div class="card-body text-center">
                        <h6 class="card-title">{{ $rec->name }}</h6>
                        <p class="card-text text-muted">${{ number_format($rec->price, 2) }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
