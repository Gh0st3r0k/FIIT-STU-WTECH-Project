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
</head>

<body class="body">
  {{-- HEADER --}}
  <header>@include('layouts.header')</header>

  <section id="main-content" class="mt-5">
    <div class="container">
      <div class="catalog-name bg-white p-2 rounded shadow mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Path | Category | Subcategory</small>
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

      <div class="bg-white rounded shadow p-4 mb-4">
        <div class="row g-5 align-items-start">

          {{-- Image & controls --}}
          <div class="col-md-6">
            <div class="position-relative border border-primary rounded p-3 admin-img-container">
              <div class="d-flex justify-content-end mb-2 gap-2">
                <form action="{{ route('products.image.upload', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <input type="file" name="images[]" class="form-control form-control-sm mb-1" multiple
                    onchange="this.form.submit()">
                </form>
              </div>

              @if ($product->images->count())
            <div id="carouselProductImages" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach ($product->images as $index => $image)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
          <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded"
            style="max-height: 350px; object-fit: contain;" alt="Image {{ $index + 1 }}">
          <form action="{{ route('products.image.delete', [$product->id, $image->id]) }}" method="POST"
            class="position-absolute top-0 end-0 m-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
          </form>

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
          </div>
          {{-- Product Details --}}
          <div class="col-md-6">
            <form id="updateForm" method="POST" action="{{ route('products.update', $product->id) }}">
              @csrf
              @method('PUT')

              <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 id="productName" class="mb-0 product-title border border-primary p-1" contenteditable="true"
                  oninput="document.getElementById('nameInput').value = this.innerText">
                  {{ $product->name }}
                </h3>
              </div>

              <input type="hidden" name="name" id="nameInput" value="{{ $product->name }}">
              <input type="hidden" name="description" id="descInput" value="{{ $product->description }}">
              <input type="hidden" name="price" id="priceInputHidden" value="{{ $product->price }}">

              <div class="d-flex align-items-center mb-3">
                <input id="priceInput" type="number" class="form-control w-50" step="0.01" value="{{ $product->price }}"
                  oninput="document.getElementById('priceInputHidden').value = this.value" required />
                <select class="form-select form-select-sm w-auto">
                  <option value="usd" selected>USD</option>
                  <option value="eur">EUR</option>
                  <option value="uah">UAH</option>
                </select>
              </div>

              <div id="productDescription" class="p-2 border border-primary rounded" contenteditable="true"
                oninput="document.getElementById('descInput').value = this.innerText">
                {{ $product->description }}
              </div>

              <div class="d-flex align-items-center justify-content-start gap-2 mt-3">
                <button type="submit" class="btn btn-warning btn-sm" title="Save changes">Save</button>
            </form>

            <form method="POST" action="{{ route('products.destroy', $product->id) }}">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm" title="Delete product">Delete</button>
            </form>
          </div>

          <div class="mb-3 d-flex align-items-center gap-2 mt-4">
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
            <p class="fw-bold mb-1">{{ $product->name }}</p>
            <p class="mb-0">{{ $product->description }}</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Related Products --}}
    <div class="bg-white rounded shadow p-4">
      <h3 class="mb-3">You may like</h3>
      <div class="row" id="productsCard">
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
  <script>
    const form = document.getElementById('updateForm');
    const nameInput = document.getElementById('nameInput');
    const descInput = document.getElementById('descInput');
    const editableName = document.getElementById('productName');
    const editableDesc = document.getElementById('productDescription');

    form?.addEventListener('submit', function (e) {
      nameInput.value = editableName.innerText.trim();
      descInput.value = editableDesc.innerText.trim();
      showSaveAlert();
    });

    function showSaveAlert() {
      const alert = document.createElement('div');
      alert.className = 'alert alert-success position-fixed top-0 end-0 mt-3 me-3 shadow';
      alert.textContent = '✔ Changes saved successfully!';
      document.body.appendChild(alert);
      setTimeout(() => alert.remove(), 2500);
    }
  </script>
</body>

</html>