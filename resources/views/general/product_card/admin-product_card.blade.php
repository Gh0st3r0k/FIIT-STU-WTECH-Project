<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Page</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/general/product_card/admin-product_card.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="{{ asset('js/general/product_card/admin-product_card.js') }}" defer></script>
</head>

<body class="body">

  {{-- HEADER --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="mt-5">
    <div class="container">

      {{-- Product Info --}}
      <div class="catalog-name bg-white p-2 rounded shadow mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Path | Category | Subcategory</small>
            <h2 class="fw-bold mt-1">Catalog name</h2>
          </div>
          <div class="d-flex align-items-center mt-3 mt-md-0">
            <span class="me-2 fs-5">Name Surname</span>
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- Main Content --}}
      <div class="bg-white rounded shadow p-4 mb-4">
        <div class="row g-5 align-items-start">

          {{-- Image & controls --}}
          <div class="col-md-6">
            <div class="position-relative border border-primary rounded p-3 admin-img-container">
              <button class="btn btn-sm btn-success position-absolute add-btn" title="Add new image"><i class="fas fa-plus"></i></button>
              <button class="btn btn-sm btn-danger position-absolute remove-btn" title="Remove image"><i class="fas fa-minus"></i></button>

              <div class="d-flex align-items-center justify-content-center h-100">
                <button class="btn btn-link fs-2 text-dark me-3" id="prevBtn" aria-label="Previous image">
                  <i class="fa-solid fa-chevron-left"></i>
                </button>
                <img id="galleryImg" src="{{ asset('img/dogfood.jpg') }}" alt="Product Gallery" class="img-fluid border border-2 rounded product-img" />
                <button class="btn btn-link fs-2 text-dark ms-3" id="nextBtn" aria-label="Next image">
                  <i class="fa-solid fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>

          {{-- Product Details --}}
          <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h3 class="mb-0 product-title border border-primary p-1" contenteditable="true">Text Name</h3>
              <div class="d-flex gap-2">
                <button class="btn btn-warning btn-sm" title="Save changes">Save</button>
                <button class="btn btn-danger btn-sm" title="Delete product">Delete product</button>
              </div>
            </div>

            <div class="d-flex align-items-center mb-3">
              <h4 class="text-muted me-3 mb-0">$50</h4>
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

            <div class="p-2 border border-primary rounded" contenteditable="true">
              <p class="fw-bold mb-1">Nutritious Dog Food</p>
              <p class="mb-0">
                Our premium dog food uses natural, high-quality ingredients to keep your pet healthy and full of energy. Suitable for all breeds and ages.
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- Description --}}
      <div class="bg-white rounded shadow p-4 mb-4 border border-primary" contenteditable="true">
        <h3>Product Details</h3>
        <div class="p-3">
          <p>Here you can post detailed information about the product: <br />TEXT TEXT TEXT TEXT...</p>
        </div>
      </div>

      {{-- Related Products --}}
      <div class="bg-white rounded shadow p-4">
        <h3 class="mb-3">You may like</h3>
        <div class="row" id="productsCard">
          {{-- Пример карточек товаров --}}
          @for($i = 0; $i < 4; $i++)
          <div class="col-6 col-sm-4 col-md-4 col-lg-3 mb-3">
            <div class="card h-100 shadow-sm">
              <img src="{{ asset('img/Fon.png') }}" class="card-img-top" alt="Product Image" />
              <div class="card-body p-1 text-center">
                <h5 class="card-title fs-6">Product Name</h5>
                <p class="card-text mb-2">$29.99</p>
                <button class="btn btn-outline-dark btn-sm px-3 py-1">
                  <i class="fas fa-cart-plus me-1"></i> <span class="d-none d-sm-inline">Add to Cart</span>
                </button>
              </div>
            </div>
          </div>
          @endfor
        </div>
      </div>

    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>