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
  <script src="{{ asset('js/general/catalog/admin-catalog.js') }}" defer></script>
</head>

<body>
  {{-- Header --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="mt-5">
    <div class="container-fluid">
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

      <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 col-lg-2 d-none d-md-block">
          {{-- Sidebar filters --}}
          {{-- ...весь твой фильтр код тут можно оставить без изменений --}}
        </div>

        {{-- Main catalog content --}}
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4">
          {{-- Burger button (filters mobile) --}}
          {{-- ...твой код без изменений --}}

          {{-- Products wrapper --}}
          <div class="products-wrapper bg-white p-4 rounded shadow">
            {{-- Search & Sort --}}
            {{-- ...твой код без изменений --}}

            {{-- Cards --}}
            <div class="row" id="productsCard">
              {{-- Карточки продуктов --}}
              @foreach ($products as $product)
            <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <!-- <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}"> -->
              @if ($product->image)
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          @else
          <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}">
          @endif


              <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <p class="card-text text-muted">${{ number_format($product->price, 2) }}</p>
              <p class="card-text">{{ $product->description }}</p>
              <a href="{{ route('admin.product.show', $product->id) }}"
                class="btn btn-outline-primary w-100 mt-2">
                ✏ Change
              </a>

              </div>
            </div>
            </div>
        @endforeach
            </div>

            <!-- {{-- Форма добавления продукта --}}
            <div class="row mt-4">
              <div class="col-12">
                <div class="p-4 bg-white rounded shadow">
                  <h5 class="mb-3">Add new product</h5>
                  <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                      <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                      </div>
                      <div class="col-md-4">
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="description" class="form-control" placeholder="Description">
                      </div>
                      <div class="col-12">
                        <button class="btn btn-success w-100 mt-2">Add Product</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div> -->

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