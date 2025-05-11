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

    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    {{-- Header --}}
    <header>
      @include('layouts.header')
    </header>

    <section id="main-content" class="pt-5 mt-5">
        <div class="container">
            <h2 class="pt-2 pb-2 mb-4 bg-white rounded shadow">All Orders</h2>

            @foreach ($orders as $order)
                <div class="bg-white rounded shadow p-4 mb-4 admin-order-block" data-order-id="{{ $order->id }}">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                        <h5 class="fw-bold mb-0">
                            User:
                            @if ($order->user)
                                {{ $order->user->name }} {{ $order->user->surname }}
                            @elseif ($order->nonUser)
                                {{ $order->nonUser->name }} {{ $order->nonUser->surname }}
                            @else
                                Unknown
                            @endif
                        </h5>
                        <button class="btn btn-warning btn-sm status-button">Ready🔄</button>
                    </div>
                    <div class="ms-2">
                        @foreach ($order->products as $product)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $product->name }}</span>
                                <span class="fw-bold">x{{ $product->pivot->count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach


        </div>
    </section>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
