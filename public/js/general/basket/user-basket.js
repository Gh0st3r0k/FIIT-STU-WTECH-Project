document.addEventListener("DOMContentLoaded", function () {
  const isAuthenticated = document.body.dataset.auth === "1";
  const basketContent = document.getElementById("basketContent");
  const totalElem = document.getElementById("basketTotal");

  function renderGuestBasket() {
    const stored = localStorage.getItem("basket");
    const items = stored ? JSON.parse(stored) : [];

    let total = 0;
    basketContent.innerHTML = ''; // очистить содержимое

    items.forEach(item => {
      const subtotal = item.price * item.count;
      total += subtotal;

      const row = document.createElement('div');
      row.className = 'basket-item row py-3 align-items-center';
      row.dataset.price = item.price;
      row.dataset.productId = item.id;
      const imageUrl = item.image.startsWith('http') || item.image.startsWith('/')
      ? item.image
      : '/storage/' + item.image;
    
    row.innerHTML = `
      <div class="col-3"><img src="${imageUrl}" class="img-fluid basket-img"/></div>
        <div class="col-3">${item.name}</div>
        <div class="col-2">$${item.price.toFixed(2)}</div>
        <div class="col-2">
          <input type="number" class="form-control basket-qty" value="${item.count}" min="0" />
        </div>
        <div class="col-2 fw-bold item-subtotal">$${subtotal.toFixed(2)}</div>
      `;

      basketContent.appendChild(row);
      basketContent.appendChild(document.createElement('hr'));
    });

    totalElem.textContent = "Total: $" + total.toFixed(2);
  }

  function updateGuestBasketTotals() {
    const rows = document.querySelectorAll(".basket-item");
    let newTotal = 0;

    rows.forEach(row => {
      const price = parseFloat(row.dataset.price);
      const input = row.querySelector(".basket-qty");
      const subtotalElem = row.querySelector(".item-subtotal");
      const quantity = parseInt(input.value);

      const subtotal = price * quantity;
      subtotalElem.textContent = "$" + subtotal.toFixed(2);
      newTotal += subtotal;
    });

    totalElem.textContent = "Total: $" + newTotal.toFixed(2);
  }

  if (!isAuthenticated) {
    renderGuestBasket();

    document.querySelectorAll(".basket-qty").forEach(input => {
      input.addEventListener("input", () => {
        const row = input.closest(".basket-item");
        const productId = parseInt(row.dataset.productId);
        let newQty = parseInt(input.value);
        if (isNaN(newQty) || newQty < 0) newQty = 0;

        let basket = JSON.parse(localStorage.getItem("basket") || "[]");

        if (newQty === 0) {
          basket = basket.filter(p => p.id !== productId);
          row.remove();
        } else {
          basket = basket.map(p =>
            p.id === productId ? { ...p, count: newQty } : p
          );
        }

        localStorage.setItem("basket", JSON.stringify(basket));
        updateGuestBasketTotals();
      });
    });
  }
  else {
    document.querySelectorAll(".basket-qty").forEach(input => {
      input.addEventListener("input", () => {
        const row = input.closest(".basket-item");
        const productId = parseInt(row.dataset.productId);
        const newQty = parseInt(input.value);
    
        if (isNaN(newQty) || newQty < 0) return;
    
        fetch('/api/basket/update', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({ product_id: productId, count: newQty })
        })
        .then(res => res.json())
        .then(() => {
          if (newQty === 0) {
            row.remove(); // ❗ Удалить карточку с UI
            const hr = row.nextElementSibling;
            if (hr && hr.tagName === "HR") hr.remove();
          }
          updateGuestBasketTotals();
        })
        .catch(err => console.error(err));
      });
    });
  }
});
