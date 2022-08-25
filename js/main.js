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

const precios = document.querySelectorAll(".precio");

let guarniciones = [];
function hola(valor, id, precio) {
  const objetoGuarniciones = {
    id: id,
    nombre: valor,
    precio: precio,
  };
  guarniciones.push(objetoGuarniciones);

  const precioHTML = document.getElementById(id);
  const html = precioHTML.dataset.precio;
  precioHTML.innerHTML = (parseFloat(html) + parseFloat(precio)).toFixed(2);
}

// *******************

let products = [];

recuperarLocalStorage();

function add(id, product, price, img, categ) {
  let guarnicion = "";
  let guarnicionPrecio = 0;
  for (let i = 0; i < guarniciones.length; i++) {
    if (guarniciones[i].id === id) {
      guarnicion = guarniciones[i].nombre;
      guarnicionPrecio = guarniciones[i].precio;
    }
  }

  for (let item in products) {
    if (
      products[item].nombre === product &&
      products[item].guarnicion === guarnicion
    ) {
      products[item].count++;
      sendLocalStorage();
      sumarCantidad();
      pintarHTML();
      // sumar();
      return;
    }
  }

  const nuevoObjeto = {
    id: id,
    nombre: product,
    precio: parseFloat(price),
    imagen: img,
    count: 1,
    guarnicion: guarnicion,
    guarnicionPrecio: parseFloat(guarnicionPrecio),
    categoria: parseInt(categ),
  };

  if (
    nuevoObjeto.guarnicion === "" &&
    (nuevoObjeto.categoria === 1 ||
      nuevoObjeto.categoria === 2 ||
      nuevoObjeto.categoria === 3)
  ) {
    if (nuevoObjeto.categoria === 1 || nuevoObjeto.categoria === 2) {
      alert("Debés elegir una guarnición.");
    } else {
      alert("Debés elegir una salsa.");
    }
    return;
  }

  products.push(nuevoObjeto);
  sendLocalStorage();
  sumarCantidad();
  pintarHTML();
  // sumar();
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
      pintarHTML();
      sumarCantidad();
      // sumar();
    }
  });
}

window.addEventListener("load", () => pintarHTML());
const containerCarrito = document.querySelector(".container-carrito");

function pintarHTML() {
  recuperarLocalStorage();
  sumarTotal();

  containerCarrito.innerHTML = products
    .map((product) => {
      return `
      <div class="item">
        <img src="img/productos/${product.imagen}" alt="" class="img-carrito">
        <div class="textos">
          <p>${product.nombre}</p>
          <p>Cantidad: ${product.count}</p>
          <p class="guarnicion">Guarnición/Salsa:</p>
          <p class="guarnicion2">${product.guarnicion}</p>
          <p class="precio">$${
            (product.precio + product.guarnicionPrecio) * product.count
          }</p>
        </div>
        <button class="btn-eliminar" id="${product.nombre}">X</button>
     </div>`;
    })
    .join("");

  const btnBorrar = document.querySelectorAll(".btn-eliminar");
  btnBorrar.forEach((element) => {
    element.addEventListener("click", (e) => {
      let borrar = 0;
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

function sumarTotal() {
  let total = 0;
  let productos = "";

  for (let item in products) {
    if (products[item].guarnicion === "") {
      total += products[item].precio * products[item].count;
      productos += products[item].nombre + "(" + products[item].count + ") ";
    } else {
      productos +=
        products[item].nombre +
        " con " +
        products[item].guarnicion +
        "(" +
        products[item].count +
        ") ";
      total +=
        (products[item].precio + products[item].guarnicionPrecio) *
        products[item].count;
    }
  }
  document.querySelector(".totall").innerHTML = `$${total}`;
  document.getElementById("caja-total").value = total;
  document.getElementById("caja-productos").value = productos;
  return total;
}

// function sumar() {
//   let total = 0;

//   for (let item in products) {
//     if (products[item].guarnicion === "") {
//       total += products[item].precio * products[item].count;
//     } else {
//       total +=
//         (products[item].precio + products[item].guarnicionPrecio) *
//         products[item].count;
//     }
//   }
//   document.querySelector(".total-p").innerHTML = `Total: $${parseFloat(
//     total
//   ).toFixed(2)}`;
// }
