<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Orders</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/general/basket/admin-basket.css') }}" />

    <!-- Custom JS -->
    <script src="{{ asset('js/general/basket/admin-basket.js') }}" defer></script>
</head>
<body>

    {{-- Header --}}
    <header>
      @include('layouts.header')
    </header>

    <section id="main-content" class="pt-5 mt-5">
        <div class="container">
            <h2 class="pt-2 pb-2 mb-4 bg-white rounded shadow">All Orders</h2>

            {{-- Заказ 1 --}}
            <div class="bg-white rounded shadow p-4 mb-4 admin-order-block">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h5 class="fw-bold mb-0">User: Name Surname</h5>
                    <button class="btn btn-warning btn-sm status-button">Ready🔄</button>
                </div>
                <div class="ms-2">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Text Name (product 1)</span>
                        <span class="fw-bold">x3</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Text Name 2</span>
                        <span class="fw-bold">x2</span>
                    </div>
                </div>
            </div>

            {{-- Заказ 2 --}}
            <div class="bg-white rounded shadow p-4 mb-4 admin-order-block">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h5 class="fw-bold mb-0">User: Another Name</h5>
                    <button class="btn btn-warning btn-sm status-button">Ready🔄</button>
                </div>
                <div class="ms-2">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Dog Food Premium</span>
                        <span class="fw-bold">x1</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Smart Watch</span>
                        <span class="fw-bold">x2</span>
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
