document.addEventListener("DOMContentLoaded", function () {
    const productsContainer = document.getElementById("productsCard");
  
    // Number of cards
    const numberOfCards = 13;
  
    // HTML template of one card
    const productCardHTML = `
      <div class="col-6 col-sm-4 col-md-4 col-lg-3 mb-3">
        <div class="card h-100 shadow-sm">
          <a href="../../ProductCard/Admin/ProductCard.html" class="text-decoration-none text-dark">
            <img src="../../../img/Fon.png" class="card-img-top" alt="Bluetooth Speaker">
            <div class="card-body p-1 text-center">
              <h5 class="card-title fs-6 fs-md-5 fs-lg-5 fs-xl-4">Bluetooth Speaker</h5>
              <p class="card-text fs-6 fs-md-5 mb-2 mb-sm-3">$29.99</p>
            </div>
          </a>
          <div class="text-center pb-2">
            <button class="btn btn-secondary btn-sm px-3 py-1 fs-6"
                    onclick="event.stopPropagation();">
              <i class="fas fa-edit"></i>
              <span class="d-none d-sm-inline">Change</span>
            </button>
          </div>
        </div>
      </div>
    `;
  
    // Add card cycle
    for (let i = 0; i < numberOfCards; i++) {
      productsContainer.insertAdjacentHTML("beforeend", productCardHTML);
    }
  });
  