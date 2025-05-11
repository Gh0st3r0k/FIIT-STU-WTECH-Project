document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".status-button").forEach((btn) => {
    btn.addEventListener("click", () => {
      const orderBlock = btn.closest(".admin-order-block");
      const orderId = orderBlock.dataset.orderId;

      fetch(`/admin/orders/${orderId}/status`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({}) // ничего не надо, просто POST
      })
        .then(res => {
          if (!res.ok) throw new Error("Request failed");
          return res.json();
        })
        .then(data => {
          btn.textContent = "Ready ✅";
          btn.classList.remove("btn-warning");
          btn.classList.add("btn-success");
          btn.disabled = true;
        })
        .catch(err => {
          alert("❌ Error updating order status");
          console.error(err);
        });
    });
  });
});
