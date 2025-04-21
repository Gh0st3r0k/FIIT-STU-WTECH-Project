<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Catalog</title>

  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/general/catalog/user-catalog.css') }}" />
  <script src="{{ asset('js/general/catalog/user-catalog.js') }}" defer></script>
</head>
<body>

  {{-- HEADER --}}
  <header>
    @include('layouts.header')
  </header>

  <section id="main-content" class="mt-5">
    <div class="container-fluid">

      {{-- Заголовок каталога --}}
      <div class="catalog-name bg-white p-2 w-100 rounded shadow mb-2 mt-1">
        <div class="d-flex justify-content-between align-items-center flex-wrap ps-4 pe-4">
          <div class="d-flex flex-column">
            <small class="text-muted">Path | dfghvfdghjk | sdfghjkm,l</small>
            <h2 class="fw-bold mt-1">Catalog name</h2>
          </div>
          <a href="{{ url('/user/profile') }}" class="d-flex align-items-center text-decoration-none text-dark mt-3 mt-md-0">
            @php $user = session('user') ?? ['name' => 'Guest', 'surname' => '']; @endphp
            <span class="me-2 fs-5">{{ $user['name'] }} {{ $user['surname'] }}</span>
            <div class="rounded-circle bg-light p-2">
              <i class="fas fa-user fa-lg text-primary"></i>
            </div>
          </a>
        </div>
      </div>

      <div class="row">
        {{-- SIDEBAR --}}
        <div class="col-md-3 col-lg-2 d-none d-md-block">
          {{-- Оставь свой sidebar здесь, как есть --}}
          {{-- ... --}}
        </div>

        {{-- CONTENT --}}
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4">
          {{-- MOBILE TOGGLE --}}
          {{-- ...твой оффканвас и фильтры --}}

          <div class="products-wrapper bg-white p-4 rounded shadow">
            {{-- Search and Sorting --}}
            {{-- ... --}}

            {{-- Cards --}}
            <div class="row" id="productsCard">
              {{-- Здесь JS вставляет карточки --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
