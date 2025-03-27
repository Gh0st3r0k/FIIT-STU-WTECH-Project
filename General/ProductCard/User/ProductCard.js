
const galleryImages = [
  "../../../img/test_gal1.jpg",
  "../../../img/test_gal2.jpg",
  "../../../img/test_gal3.jpg",
];

let currentIndex = 0; 
const galleryImg = document.getElementById("galleryImg");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

// Funkcia na nastavenie aktuálneho obrázka
function showImage(index) {
  galleryImg.src = galleryImages[index];
}

// Obsluha tlačidiel
prevBtn.addEventListener("click", () => {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = galleryImages.length - 1; 
  }
  showImage(currentIndex);
});

nextBtn.addEventListener("click", () => {
  currentIndex++;
  if (currentIndex >= galleryImages.length) {
    currentIndex = 0; 
  }
  showImage(currentIndex);
});

showImage(currentIndex);
