<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Basket</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/general/basket/user-basket.css') }}" />
</head>

<body class="body">
  
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
            @php $user = session('user') ?? ['name' => 'Guest', 'surname' => '']; @endphp
            <span class="me-2 fs-5">{{ $user['name'] }} {{ $user['surname'] }}</span>            
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- Product Items --}}
      <div class="bg-white rounded shadow p-4 mb-4">
        {{-- Item 1 --}}
        <div class="basket-item row py-3 gx-2 gx-md-4 align-items-center">
          <div class="col-4 col-sm-2 col-md-1">
            <img src="{{ asset('img/test_gal1.jpg') }}" alt="Product Image" class="img-fluid basket-item-image" />
          </div>
          <div class="col-8 col-sm-4 col-md-3">
            <h5 class="fw-bold mb-1">Text Name</h5>
            <span class="text-muted d-sm-none">$50</span>
          </div>
          <div class="col-4 col-sm-2 col-md-2 text-muted d-none d-sm-block">$50</div>
          <div class="col-4 col-sm-2 col-md-2 ms-auto ms-sm-0 d-flex justify-content-end">
            {{--TODO: style delete--}}
            <input title="Quantity" type="number" class="form-control form-control-sm text-center basket-qty" value="3" min="1" style="max-width: 60px" />
          </div>
          <div class="col-4 col-sm-2 col-md-2 text-end fw-bold d-none d-md-block">$150</div>
        </div>
        <hr />

        {{-- Item 2 --}}
        <div class="basket-item row py-3 gx-2 gx-md-4 align-items-center">
          <div class="col-4 col-sm-2 col-md-1">
            <img src="{{ asset('img/test_gal2.jpg') }}" alt="Product Image" class="img-fluid basket-item-image" />
          </div>
          <div class="col-8 col-sm-4 col-md-3">
            <h5 class="fw-bold mb-1">Text Name 2</h5>
            <span class="text-muted d-sm-none">$50</span>
          </div>
          <div class="col-4 col-sm-2 col-md-2 text-muted d-none d-sm-block">$50</div>
          <div class="col-4 col-sm-2 col-md-2 ms-auto ms-sm-0 d-flex justify-content-end">
            {{--TODO: style delete--}}
            <input title="Quantity" type="number" class="form-control form-control-sm text-center basket-qty" value="1" min="1" style="max-width: 60px" />
          </div>
          <div class="col-4 col-sm-2 col-md-2 text-end fw-bold d-none d-md-block">$50</div>
        </div>
        <hr />

        <div class="row justify-content-end mt-4">
          <div class="col-md-4 text-end fw-bold fs-5">Total: $200</div>
        </div>
      </div>

      <div class="text-center">
        <button class="btn btn-dark btn-lg pay-button" data-bs-toggle="modal" data-bs-target="#paymentModal">PAY</button>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Modal with Form -->
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
            <div class="mb-3"><label class="form-label">Name</label><input type="text" class="form-control" placeholder="Name" name="fname" /></div>
            <div class="mb-3"><label class="form-label">Surname</label><input type="text" class="form-control" placeholder="Surname" name="lname" /></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="Email" name="email" /></div>
            <div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" placeholder="Address" name="address" /></div>
            <div class="row mt-4">
              <div class="col-12 col-md-6 mb-2">
                <button type="button" class="btn btn-dark w-100">
                  <i class="fab fa-apple-pay me-2"></i> Apple Pay
                </button>
              </div>
              <div class="col-12 col-md-6">
                <button type="button" class="btn btn-success w-100">
                  <i class="fab fa-google-pay me-2"></i> Google Pay
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>