const menu = document.querySelector(".barra");
const container = document.querySelector(".items-container");

menu.addEventListener("click", () => {
  container.classList.toggle("show");
});

// **********************

window.addEventListener("load", () => pintarHTML());
const listaCarrito = document.querySelector(".lista-carrito");
let productos = [];

function recuperarLocalStorage() {
  if (localStorage.getItem("productos")) {
    productos = JSON.parse(localStorage.getItem("productos"));
  }
}

function pintarHTML() {
  recuperarLocalStorage();
  listaCarrito.innerHTML = productos
    .map((product) => {
      return `
		<div class="item2">
			<div class="textos2">
				<p class="nombre2">${product.nombre}</p>
				<div class="guarnicion3">
					<p>${product.guarnicion}</p>
				</div>
				<div class="precio2">
					<p>x${product.count}</p>
					<p>$${(product.precio + product.guarnicionPrecio) * product.count}</p>
				</div>
			</div>
		</div>`;
    })
    .join("");
}

const precio = document.getElementById("mostrarPrecio");
const total = document.getElementById("total");
function mostrarPrecio(valor, nombre, subtotal) {
  precio.innerHTML = `El precio del envío es de $${valor}`;
  document.getElementById("caja-localidad").value = nombre;
  total.innerHTML = `$${parseFloat(valor) + parseFloat(subtotal)}`;
}
