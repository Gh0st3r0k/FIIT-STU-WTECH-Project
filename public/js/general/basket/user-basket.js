document.addEventListener("DOMContentLoaded", function () {
    const totalElem = document.querySelector(".fs-5.text-end");
  
    function updateTotal() {
      let total = 0;
  
      document.querySelectorAll(".basket-item").forEach(row => {
        const price = parseFloat(row.dataset.price);
        const qtyInput = row.querySelector(".basket-qty");
        const qty = parseInt(qtyInput.value);
        const subtotal = price * qty;
        total += subtotal;
  
        const subtotalElem = row.querySelector(".item-subtotal");
        if (subtotalElem) {
          subtotalElem.textContent = "$" + subtotal.toFixed(2);
        }
      });
  
      totalElem.textContent = "Total: $" + total.toFixed(2);
    }
  
    document.querySelectorAll(".basket-qty").forEach(input => {
      input.addEventListener("change", function () {
        const row = input.closest(".basket-item");
        let qty = parseInt(this.value);
        const productId = row.dataset.productId;
  
        if (isNaN(qty) || qty < 0) qty = 0;
  
        if (qty === 0) {
          row.remove();
          fetch('/api/basket/delete', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ product_id: productId })
          });
        } else {
          fetch('/api/basket/update', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ product_id: productId, quantity: qty })
          });
        }
  
        updateTotal();
      });
    });
  
    updateTotal(); // пересчитать при загрузке
  });
  