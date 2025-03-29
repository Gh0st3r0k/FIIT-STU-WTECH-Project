document.querySelectorAll(".status-button").forEach((btn) => {
  btn.addEventListener("click", () => {
    if (btn.textContent.trim() === "Ready🔄") {
      btn.textContent = "Ready ✅";
      btn.classList.remove("btn-warning");
      btn.classList.add("btn-success");
    } else {
      btn.textContent = "Ready🔄";
      btn.classList.remove("btn-success");
      btn.classList.add("btn-warning");
    }
  });
});
