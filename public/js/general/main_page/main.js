
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
        // Авторизованный пользователь — всё хорошо
        console.log('Товар добавлен в корзину (авторизован)');
      } else if (data.guest) {
        // Гость — получаем данные о товаре с DOM
        const productCard = document.querySelector(`[data-product-id="${productId}"]`);
        const name = productCard.querySelector('.card-title').textContent.trim();
        const price = parseFloat(productCard.querySelector('.card-text').textContent.replace('$', ''));
        const image = productCard.querySelector('img')?.getAttribute('src') || '';
  
        // Работа с localStorage
        let basket = JSON.parse(localStorage.getItem('basket') || '[]');
        const existing = basket.find(item => item.id === productId);
        if (existing) {
          existing.count += 1;
        } else {
          basket.push({ id: productId, name, price, count: 1, image });
        }
        localStorage.setItem('basket', JSON.stringify(basket));
        console.log('Товар добавлен в localStorage');
      }
    });
  };