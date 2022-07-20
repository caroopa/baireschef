const menu = document.querySelector(".barra");
const container = document.querySelector(".items-container");

menu.addEventListener("click", () => {
  container.classList.toggle("show");
});

// **********************

const primaryNav = document.querySelector(".carrito");
const navToggle = document.querySelector(".cart");
const cerrar = document.querySelector(".btn-cerrar");

navToggle.addEventListener("click", () => {
  const visibility = primaryNav.getAttribute("data-visible");
  if (visibility === "false") {
    primaryNav.setAttribute("data-visible", "true");
  }
});

cerrar.addEventListener("click", () => {
  const visibility = primaryNav.getAttribute("data-visible");
  if (visibility === "true") {
    primaryNav.setAttribute("data-visible", "false");
  }
});

// **********************

ventanaModal = document.querySelectorAll(".ventana-modal");

function abrirModal(i) {
  ventanaModal[i - 1].classList.add("show-modal");
}

function cerrarModal(i) {
  ventanaModal[i - 1].classList.remove("show-modal");
}

// ********************

const select = document.querySelectorAll(".select-guarnicion");
let guarniciones = [];
select.forEach((element) => {
  guarniciones.push(element.value);
});

let products = [];

recuperarLocalStorage();

function add(id, product, price, img) {
  for (let item in products) {
    if (products[item].nombre === product) {
      products[item].count++;
      sendLocalStorage();
      sumarCantidad();
      pintarHTML();
      return;
    }
  }
  const nuevoObjeto = {
    id: id,
    nombre: product,
    precio: parseFloat(price),
    imagen: img,
    count: 1,
  };
  products.push(nuevoObjeto);
  sendLocalStorage();
  sumarCantidad();
  pintarHTML();
}

function sumarCantidad() {
  let total = 0;
  for (let item in products) {
    total += 1 * products[item].count;
  }
  document.getElementById("checkout").innerHTML = total;
}

function sendLocalStorage() {
  localStorage.setItem("productos", JSON.stringify(products));
}

function recuperarLocalStorage() {
  document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("productos")) {
      products = JSON.parse(localStorage.getItem("productos"));
      sumarCantidad();
      sumar();
      pintarHTML();
    }
  });
}

navToggle.addEventListener("click", () => pintarHTML());
const containerCarrito = document.querySelector(".container-carrito");

function pintarHTML() {
  recuperarLocalStorage();
  sumar();

  containerCarrito.innerHTML = products
    .map((product) => {
      return `
      <div class="item">
        <img src="img/${product.imagen}" alt="" class="img-carrito">
        <div class="textos">
          <p>${product.nombre}</p>
          <p>Cantidad: ${product.count}</p>
          <p class="guarnicion">Guarnición:</p>
          <p class="guarnicion2">${guarniciones[product.id - 1]}</p>
          <p class="precio">${product.precio * product.count}</p>
        </div>
        <button class="btn-eliminar" id="${product.nombre}">X</button>
     </div>`;
    })
    .join("");

  const btnBorrar = document.querySelectorAll(".btn-eliminar");
  btnBorrar.forEach((element) => {
    element.addEventListener("click", (e) => {
      let borrar = 0;

      console.log(e.target.id);
      for (let item in products) {
        if (products[item].nombre === e.target.id) {
          if (products[item].count > 1) {
            products[item].count--;
          } else {
            borrar = item;
            products.splice(borrar, 1);
          }
          break;
        }
      }

      localStorage.setItem("productos", JSON.stringify(products));
      sumarCantidad();
      pintarHTML();
    });
  });
}

function sumar() {
  let total = 0;
  let productos = "";

  for (let item in products) {
    productos += products[item].nombre + "(" + products[item].count + ") ";
    total += products[item].precio * products[item].count;
  }
  document.querySelector(".totall").innerHTML = total;
  document.getElementById("caja-total").value = total;
  document.getElementById("caja-productos").value = productos;
}
