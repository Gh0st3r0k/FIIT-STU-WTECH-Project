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

  <section id="main-content" class="mt-5">
    <div class="container">
      <div class="catalog-name bg-white p-2 rounded shadow mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Home | Catalog</small>
            <h2 class="fw-bold mt-1">User Catalog</h2>
          </div>
          <div class="d-flex align-items-center mt-3 mt-md-0">
            <span class="me-2 fs-5">Welcome</span>
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded shadow p-4">
        <div class="row" id="productsCard">
          @foreach ($products as $product)
        <div class="col-6 col-sm-4 col-md-3 mb-4">
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
      @endforeach
        </div>
      </div>
    </div>
  </section>

  @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function addToCart(productId) {
      // Later implementation: send request to backend/cart controller
      alert('Product ' + productId + ' added to cart (placeholder logic).');
    }
  </script>
</body>

</html>