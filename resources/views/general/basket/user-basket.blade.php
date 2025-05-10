<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Basket</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/general/basket/user-basket.css') }}" />

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Custom JS --}}
  <script src="{{ asset('js/general/basket/user-basket.js') }}" defer></script>
</head>

<body data-auth="{{ Auth::check() ? '1' : '0' }}">

  {{-- HEADER --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="pt-5 mt-5">
    <div class="container">
      <div class="bg-white p-2 rounded shadow mb-4 user-box">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <h2 class="fw-bold mt-1">Your Basket</h2>
          </div>
          <div class="d-flex align-items-center mt-3 mt-md-0">
            @auth
              <span class="me-2 fs-5">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
            @else
              <span class="me-2 fs-5 text-muted">Guest</span>
            @endauth
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- Product Items --}}
      <div class="container">

        <div class="bg-white rounded shadow p-4 mb-4" id="basketContent">
          @auth
            @foreach($items as $item)
              <div class="basket-item row py-3 align-items-center"
                  data-price="{{ $item['price'] }}"
                  data-product-id="{{ $item['id'] }}">
                <div class="col-3">
                  <img src="{{ asset($item['image']) }}" alt="Product Image" class="img-fluid basket-img" />
                </div>
                <div class="col-3">{{ $item['name'] }}</div>
                <div class="col-2">${{ $item['price'] }}</div>
                <div class="col-2">
                  <input type="number" class="form-control basket-qty" value="{{ $item['count'] }}" min="0" />
                </div>
                <div class="col-2 fw-bold item-subtotal">${{ number_format($item['subtotal'], 2) }}</div>
              </div>
              <hr />
            @endforeach
          @endauth
        </div>

        <div class="row justify-content-end mt-4">
          <div class="col-md-4 text-end fw-bold fs-5" id="basketTotal">
            @auth
              Total: ${{ number_format($total, 2) }}
            @else
              Total: $0.00
            @endauth
          </div>
        </div>
      </div>



      <div class="text-center">
        <button class="btn btn-dark btn-lg pay-button" data-bs-toggle="modal" data-bs-target="#paymentModal">PAY</button>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Modal --}}
  <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fw-bold" id="paymentModalLabel">Delivery form</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="fs-5 fw-semibold text-success">
            Delivery date:<br />
            <span class="text-success">Nov. 26 – Dec. 26</span>
          </p>
          <form>
            <div class="mb-3"><label class="form-label">Name</label><input type="text" class="form-control" name="fname" /></div>
            <div class="mb-3"><label class="form-label">Surname</label><input type="text" class="form-control" name="lname" /></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" /></div>
            <div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" name="address" /></div>
            <div class="row mt-4">
              <div class="col-12 col-md-6 mb-2">
                <button type="button" class="btn btn-dark w-100"><i class="fab fa-apple-pay me-2"></i> Apple Pay</button>
              </div>
              <div class="col-12 col-md-6">
                <button type="button" class="btn btn-success w-100"><i class="fab fa-google-pay me-2"></i> Google Pay</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
