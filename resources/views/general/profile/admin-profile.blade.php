<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin User Page</title>
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/general/profile/admin-profile.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>

  <header>
    @include('layouts.header')

  </header>

  <section id="main-content" class="pt-5 mt-0">
    <div class="container">
      <div class="admin-card bg-white rounded shadow p-4 mb-4 position-relative">
        <div class="row g-4 align-items-center">
          <div class="col-md-3 text-center text-md-start">
            <img src="{{ asset('img/test_gal3.jpg') }}" alt="User Avatar" class="rounded-circle user-avatar" />
          </div>
          <div class="col-md-9">
            @auth
          @php
          $user = Auth::user();
        @endphp
          <h4 class="fw-normal">{{ $user->name }} {{ $user->surname }}</h4>
          <p class="text-muted mb-1">{{ $user->email }}</p>
      @else
        <h4 class="fw-normal">Guest</h4>
        <p class="text-muted mb-1">unknown@example.com</p>
      @endauth
          </div>
        </div>
        <button class="btn btn-primary btn-sm add-product-btn" data-bs-toggle="modal" data-bs-target="#addProductModal">
          Add Product
        </button>
      </div>

    </div>
  </section>

  @include('layouts.footer')


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<!-- Кнопка для вызова модального окна -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
  Add Product
</button>

<!-- Модальное окно с полной рабочей формой -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
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
              <label for="images" class="form-label mt-2">Product images</label>
              <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary w-100">Add Product</button>
        </div>
      </form>


    </div>
  </div>