document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("productsCard");
  const searchInput = document.querySelector('#searchInput input');
  let products = [];
  let activeCategory = "all";
  let searchQuery = "";
  let activeSort = null;

  // Загрузка JSON с продуктами
  fetch("/data/products.json")
    .then(res => res.json())
    .then(data => {
      products = data;
      applyFilters();
      attachCategoryFilters();
      attachSearch();
      attachSorting();
    });

  // Рендер карточек товара
  function renderProducts(items) {
    container.innerHTML = "";
    if (items.length === 0) {
      container.innerHTML = "<p class='text-muted text-center'>No products found.</p>";
      return;
    }

    items.forEach(product => {
      const html = `
        <div class="col-6 col-sm-4 col-md-4 col-lg-3 mb-3">
          <div class="card h-100 shadow-sm">
            <a href="/user/product-card/${product.id}" class="text-decoration-none text-dark">
              <img src="${product.image}" class="card-img-top" alt="${product.name}">
              <div class="card-body p-1 text-center">
                <h5 class="card-title fs-6">${product.name}</h5>
                <p class="card-text">$${product.price.toFixed(2)}</p>
              </div>
            </a>
            <div class="text-center pb-2">
              <button class="btn btn-outline-dark btn-sm px-3 py-1 fs-6"
                      onclick="event.stopPropagation(); addToCart(${product.id});">
                <i class="fas fa-cart-plus me-1"></i>
                <span class="d-none d-sm-inline">Add to Cart</span>
              </button>
            </div>
          </div>
        </div>`;
      container.insertAdjacentHTML("beforeend", html);
    });
  }

  // Фильтрация + сортировка
  function applyFilters() {
    let result = [...products];

    // Поиск
    if (searchQuery.trim() !== "") {
      const q = searchQuery.toLowerCase();
      result = result.filter(p =>
        p.name.toLowerCase().includes(q) ||
        p.description.toLowerCase().includes(q)
      );
    }

    // Категория
    if (activeCategory !== "all") {
      result = result.filter(p => p.category === activeCategory);
    }

    // Сортировка
    switch (activeSort) {
      case "new":
        result = result.filter(p => p.isNew);
        break;
      case "price-asc":
        result.sort((a, b) => a.price - b.price);
        break;
      case "price-desc":
        result.sort((a, b) => b.price - a.price);
        break;
      case "rating":
        result.sort((a, b) => b.rating - a.rating);
        break;
    }

    renderProducts(result);
  }

  // Категории (боковая и мобильная версии)
  function attachCategoryFilters() {
    const filters = document.querySelectorAll('.category-filter');
    filters.forEach(btn => {
      btn.addEventListener('click', () => {
        activeCategory = btn.dataset.category;
        applyFilters();
      });
    });
  }

  // Обработка поиска
  function attachSearch() {
    searchInput.addEventListener('input', () => {
      searchQuery = searchInput.value;
      applyFilters();
    });
  }

  
  function attachSorting() {
    const buttons = {
      "sort-new": "new",
      "sort-price-asc": "price-asc",
      "sort-price-desc": "price-desc",
      "sort-rating": "rating"
    };
  
    Object.entries(buttons).forEach(([id, value]) => {
      document.getElementById(id).addEventListener("click", () => {
        activeSort = value;
        applyFilters();
        updateSortStyles(id);
      });
    });
  }
  
  function updateSortStyles(activeId) {
    const all = ["sort-new", "sort-price-asc", "sort-price-desc", "sort-rating"];
    all.forEach(id => {
      const btn = document.getElementById(id);
      if (id === activeId) {
        btn.classList.remove("btn-light", "text-muted");
        btn.classList.add("btn-dark");
      } else {
        btn.classList.remove("btn-dark");
        btn.classList.add("btn-light", "text-muted");
      }
    });
  }

  // Кнопки сортировки
  
    document.getElementById("sort-new").addEventListener("click", () => {
      activeSort = "new";
      applyFilters();
    });

    document.getElementById("sort-price-asc").addEventListener("click", () => {
      activeSort = "price-asc";
      applyFilters();
    });

    document.getElementById("sort-price-desc").addEventListener("click", () => {
      activeSort = "price-desc";
      applyFilters();
    });

    document.getElementById("sort-rating").addEventListener("click", () => {
      activeSort = "rating";
      applyFilters();
    });

  
});


window.addToCart = function (productId) {
  fetch('/api/basket/add', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ product_id: productId })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      //alert("Товар добавлен в корзину!");
    } else {
      //alert("Ошибка: " + (data.error || "Неизвестная"));
    }
  });
}

