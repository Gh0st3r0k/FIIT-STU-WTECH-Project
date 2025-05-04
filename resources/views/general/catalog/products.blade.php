<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Catalog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5 pt-4">
        <h2 class="fw-bold mb-4">Catalog</h2>

        <!-- Сортировка -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-4 d-flex gap-3 flex-wrap">
            <div>
                <label for="sort">Sort by:</label>
                <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest</option>
                </select>
            </div>
            <div>
                <label for="direction">Direction:</label>
                <select name="direction" id="direction" class="form-select" onchange="this.form.submit()">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
        </form>

        <!-- Каталог карточек -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">${{ number_format($product->price, 2) }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products available.</p>
            @endforelse
        </div>
    </div>
</body>

</html>