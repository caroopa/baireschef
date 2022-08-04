const menu = document.querySelector(".barra");
const container = document.querySelector(".items-container");

menu.addEventListener("click", () => {
  container.classList.toggle("show");
});

// ********************

localStorage.removeItem("productos");
