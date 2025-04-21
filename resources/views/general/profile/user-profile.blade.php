<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/general/profile/user-profile.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  </head>

  <body>
    {{-- Header --}}
    <header>
      @include('layouts.header')
    </header>

    <section id="main-content" class="pt-5 mt-5">
      <div class="container">
        <div class="user-card bg-white rounded shadow p-4 mb-4">
          <div class="row g-4 align-items-center">
            <div class="col-md-3 text-center text-md-start">
              <img src="{{ asset('img/test_gal3.jpg') }}" alt="User Avatar" class="rounded-circle user-avatar" />
            </div>
            <div class="col-md-9">
              @php $user = session('user') ?? ['name' => 'Guest', 'surname' => '', 'email' => 'unknown@example.com']; @endphp
              <h4 class="fw-normal">{{ $user['name'] }} {{ $user['surname'] }}</h4>
              <p class="text-muted mb-1">{{ $user['email'] }}</p>
              <p class="text-muted">+421 987 654 321</p>

              <div class="row mt-3 g-2">
                <!-- Валюта -->
                <div class="col-12 col-sm-6 d-flex align-items-center gap-2">
                  <span class="text-muted">Currency</span>
                  <select class="form-select form-select-sm">
                    <option value="usd" selected>USD</option>
                    <option value="eur">EUR</option>
                  </select>
                </div>
                <!-- Язык -->
                <div class="col-12 col-sm-6 d-flex align-items-center gap-2">
                  <span class="text-muted">Language</span>
                  <select class="form-select form-select-sm">
                    <option value="en" selected>EN</option>
                    <option value="sk">SK</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-light p-3 rounded d-flex justify-content-between align-items-center mb-4">
          <span class="fw-semibold">No orders on way</span>
          <button class="btn btn-success btn-sm">ADD NEW</button>
        </div>

        <div class="bg-white rounded shadow p-4 history-block">
          <h3 class="text-uppercase fw-bold fs-4 mb-3">History</h3>
          <div class="history-list">
            <div class="d-flex align-items-center border rounded p-2 mb-2">
              <img src="{{ asset('img/test_gal1.jpg') }}" alt="History item" class="history-item-image me-3" />
              <div class="flex-grow-1">
                <p class="mb-0 fw-bold">Some old order #1</p>
              </div>
              <span class="ms-auto fw-bold">$50</span>
            </div>
            <div class="d-flex align-items-center border rounded p-2 mb-2">
              <img src="{{ asset('img/test_gal2.jpg') }}" alt="History item" class="history-item-image me-3" />
              <div class="flex-grow-1">
                <p class="mb-0 fw-bold">Some old order #2</p>
              </div>
              <span class="ms-auto fw-bold">$99</span>
            </div>
            <div class="d-flex align-items-center border rounded p-2 mb-2">
              <img src="{{ asset('img/test_gal2.jpg') }}" alt="History item" class="history-item-image me-3" />
              <div class="flex-grow-1">
                <p class="mb-0 fw-bold">Some old order #3</p>
              </div>
              <span class="ms-auto fw-bold">$75</span>
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