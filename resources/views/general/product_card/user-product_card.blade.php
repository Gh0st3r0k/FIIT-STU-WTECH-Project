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
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="body">
  <header>@include('layouts.header')</header>

  <section id="main-content" class="mt-0">
    <div class="container">
      <div class="catalog-name bg-white p-2 rounded shadow mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Home / Catalog / {{ $product->name }}</small>
            <h2 class="fw-bold mt-1">Catalog name</h2>
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

      <div class="bg-white rounded shadow p-4 mb-4">
        <div class="row g-5 align-items-center">
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

          <div class="col-md-6">
            <h3 class="mb-3">{{ $product->name }}</h3>
            <div class="d-flex align-items-center mb-3">
              <h4 class="text-muted me-3 mb-0">${{ number_format($product->price, 2) }}</h4>

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
              <button class="btn btn-dark btn-sm px-3 flex-grow-1"
                      data-id="{{ $product->id }}"
                      data-name="{{ $product->name }}"
                      data-price="{{ $product->price }}"
                      data-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->path) : '' }}"
                      data-quantity="#quantityInput"
                      data-buy="1">
                BUY
              </button>

              <button class="btn btn-outline-primary btn-sm"
                      data-id="{{ $product->id }}"
                      data-name="{{ $product->name }}"
                      data-price="{{ $product->price }}"
                      data-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->path) : '' }}"
                      data-quantity="#quantityInput">
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

      <div class="bg-white rounded shadow p-4 mb-4">
        <h3>Product Details</h3>
        <div class="p-3">
          <p class="mb-0">{{ $product->description }}</p>
        </div>
      </div>

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
          <button class="btn btn-outline-dark btn-sm"
                  data-id="{{ $related->id }}"
                  data-name="{{ $related->name }}"
                  data-price="{{ $related->price }}"
                  data-image="{{ $related->images->first() ? asset('storage/' . $related->images->first()->path) : '' }}">
            <i class="fas fa-cart-plus me-1"></i>
            <span class="d-none d-sm-inline">Add to Cart</span>
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
    function addToCart(productId, count = 1, productName = '', productPrice = 0, productImage = '', redirect = false) {
      fetch('/api/basket/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ product_id: productId, count })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          if (redirect) window.location.href = @json(url('/user/basket'));
        } else if (data.guest) {
          let basket = JSON.parse(localStorage.getItem('basket') || '[]');
          const existing = basket.find(p => p.id === productId);
          if (existing) {
            existing.count += count;
          } else {
            basket.push({ id: productId, name: productName, price: productPrice, count, image: productImage });
          }
          localStorage.setItem('basket', JSON.stringify(basket));
          if (redirect) window.location.href = @json(url('/user/basket'));
        }
      });
    }

    document.querySelectorAll("button[data-id]").forEach(button => {
      button.addEventListener("click", () => {
        const id = parseInt(button.dataset.id);
        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);
        const image = button.dataset.image;
        const quantitySelector = button.dataset.quantity;
        const redirect = button.dataset.buy === "1";

        const count = quantitySelector
          ? parseInt(document.querySelector(quantitySelector)?.value || 1)
          : 1;

        addToCart(id, count, name, price, image, redirect);
      });
    });
  </script>



</body>

</html>