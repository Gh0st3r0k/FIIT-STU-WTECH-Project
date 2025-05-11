<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Page</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/general/product_card/user-product_card.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="body">
  {{-- HEADER --}}
  <header>@include('layouts.header')</header>

  <section id="main-content" class="mt-5">
    <div class="container">
      {{-- Product Info --}}
      <div class="catalog-name bg-white p-2 rounded shadow mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Home / Catalog / {{ $product->name }}</small>
            <h2 class="fw-bold mt-1">Catalog name</h2>
          </div>
          <div class="d-flex align-items-center mt-3 mt-md-0">
            @php $user = session('user') ?? ['name' => 'Guest', 'surname' => '']; @endphp
            <span class="me-2 fs-5">{{ $user['name'] }} {{ $user['surname'] }}</span>
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded shadow p-4 mb-4">
        <div class="row g-5 align-items-center">
          {{-- Image carousel --}}
          <div class="col-md-6">
            @if ($product->images->count())
          <div id="carouselProductImages" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            @foreach ($product->images as $index => $image)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
          <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded"
          style="max-height: 350px; object-fit: contain;" alt="Image {{ $index + 1 }}">
          </div>
        @endforeach
            </div>
            @if ($product->images->count() > 1)
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductImages"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
          <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselProductImages"
          data-bs-slide="next">
          <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
          <span class="visually-hidden">Next</span>
          </button>
        @endif
          </div>
      @else
        <p class="text-center">No images available.</p>
      @endif
          </div>

          {{-- Product Details --}}
          <div class="col-md-6">
            <h3 class="mb-3">{{ $product->name }}</h3>
            <div class="d-flex align-items-center mb-3">
              <h4 class="text-muted me-3 mb-0">${{ number_format($product->price, 2) }}</h4>
              <select class="form-select form-select-sm w-auto">
                <option value="usd" selected>USD</option>
                <option value="eur">EUR</option>
                <option value="uah">UAH</option>
              </select>
            </div>

            <div class="mb-3 d-flex align-items-center gap-2">
              <span class="fw-bold">Color:</span>
              <button class="btn color-circle-black" title="Black"></button>
              <button class="btn color-circle-red" title="Red"></button>
              <button class="btn color-circle-green" title="Green"></button>
            </div>

            <div class="mb-3">
              <label for="quantityInput" class="form-label">Quantity:</label>
              <input type="number" id="quantityInput" class="form-control w-50" min="1" value="1" />
            </div>

            <div class="d-flex gap-2 mb-3">
              <button class="btn btn-dark btn-sm px-3 flex-grow-1">BUY</button>
              <button class="btn btn-outline-primary btn-sm" title="Add to Basket">
                <i class="fas fa-shopping-cart"></i>
              </button>
            </div>

            <div class="p-2 border border-primary rounded">
              <p class="fw-bold mb-1">{{ $product->name }}</p>
              <p class="mb-0">{{ $product->description }}</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Product Details --}}
      <div class="bg-white rounded shadow p-4 mb-4">
        <h3>Product Details</h3>
        <div class="p-3">
          <p class="mb-0">{{ $product->description }}</p>
        </div>
      </div>

      {{-- You may like --}}
      <div class="bg-white rounded shadow p-4">
        <h3 class="mb-3">You may like</h3>
        <div class="row">
          @foreach ($products as $related)
        <div class="col-6 col-sm-4 col-md-3 mb-3">
        <div class="card h-100 shadow-sm card-hover"
          onclick="window.location='{{ route('user.product.show', $related->id) }}'">
          @if ($related->images->count())
        <img src="{{ asset('storage/' . $related->images->first()->path) }}" class="card-img-top"
        alt="Related Product Image">
      @else
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No Image">
      @endif
          <div class="card-body text-center">
          <h5 class="card-title fs-6">{{ $related->name }}</h5>
          <p class="card-text">${{ number_format($related->price, 2) }}</p>
          <button class="btn btn-outline-dark btn-sm">
            <i class="fas fa-cart-plus me-1"></i> <span class="d-none d-sm-inline">Add to Cart</span>
          </button>
          </div>
        </div>
        </div>
      @endforeach
        </div>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>