<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Catalog</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/general/catalog/admin-catalog.css') }}" />
  <!-- <script src="{{ asset('js/general/catalog/admin-catalog.js') }}" defer></script> -->
  <style>
    .card-text.description {
      max-height: 60px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .card-img-top {
      object-fit: cover;
      height: 200px;
    }
  </style>
</head>

<body>
  {{-- Header --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="mt-5">
    <div class="container">
      {{-- Title section --}}
      <div class="catalog-name bg-white p-2 w-100 rounded shadow mb-2 mt-1">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Path | dfghvfdghjk | sdfghjkm,l</small>
            <h2 class="fw-bold mt-1">Catalog name</h2>
          </div>
          <a href="{{ url('/admin/profile') }}"
            class="d-flex align-items-center text-decoration-none text-dark mt-3 mt-md-0">
            <span class="me-2 fs-5">Admin Name Surname</span>
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </a>
        </div>
      </div>

      <div class="row justify-content-center">
        {{-- Main catalog content --}}
        <div class="col-lg-11">
          <div class="products-wrapper bg-white p-4 rounded shadow">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="productsCard">
              {{-- Карточки продуктов --}}
              @foreach ($products as $product)
            <div class="col mb-4">
            <div class="card h-100 shadow-sm">
              @if ($product->images->isNotEmpty())
          <img src="{{ asset('storage/' . $product->images->first()->path) }}" class="card-img-top"
          alt="{{ $product->name }}">
          @else
          <img src="{{ asset('img/placeholder.png') }}" class="card-img-top" alt="Placeholder">
          @endif

              <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <p class="card-text text-muted">${{ number_format($product->price, 2) }}</p>
              <p class="card-text description">{{ $product->description }}</p>
              <a href="{{ route('admin.product.show', $product->id) }}"
                class="btn btn-outline-primary w-100 mt-2">
                ✏ Change
              </a>
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

  {{-- Footer --}}
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>