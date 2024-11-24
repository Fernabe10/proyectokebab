window.addEventListener("load", function () {
    cargarCarrito();

    function cargarCarrito() {
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        const carritoContainer = document.getElementById("carritoContainer");
        carritoContainer.innerHTML = ""; // Limpiar el contenedor

        if (carrito.length === 0) {
            carritoContainer.innerHTML = `<tr><td colspan="4">El carrito está vacío.</td></tr>`;
            return;
        }

        carrito.forEach((item, index) => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td>${item.nombre}</td>
                <td>${item.cantidad}</td>
                <td>€${item.precio_total}</td>
                <td>
                    <button onclick="eliminarDelCarrito(${index})">Eliminar</button>
                </td>
            `;
            carritoContainer.appendChild(fila);
        });

        // Añadir evento al botón "Vaciar Carrito"
        document.getElementById("vaciarCarrito").addEventListener("click", vaciarCarrito);
    }

    function eliminarDelCarrito(index) {
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        carrito.splice(index, 1); // Eliminar el producto del carrito
        localStorage.setItem("carrito", JSON.stringify(carrito));
        cargarCarrito();
    }

    function vaciarCarrito() {
        localStorage.removeItem("carrito"); // Vaciar el carrito en localStorage
        cargarCarrito();
    }

    let btnPedir = document.getElementById("Pedir");

    btnPedir.addEventListener("click", function () {
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

        if (carrito.length === 0) {
            alert("El carrito está vacío. Agrega productos antes de realizar el pedido.");
            return;
        }

        // Mostrar confirmación antes de proceder
        const confirmar = confirm("¿Estás seguro de que quieres realizar el pedido?");
        if (!confirmar) return;

        // Enviar los datos del carrito a la API de pedidos
        fetch("Api/ApiPedido.php", { 
            method: "POST", 
            headers: { "Content-Type": "application/json" }, 
            body: JSON.stringify(carrito) 
        })
            .then((respuesta) => respuesta.text()) // Leer como texto en lugar de JSON
            .then((texto) => {
                console.log("Respuesta del servidor:", texto);
                try {
                    const datos = JSON.parse(texto); // Intenta convertirlo en JSON
                    if (datos.error) {
                        alert(`Error al realizar el pedido: ${datos.error}`);
                    } else {
                        alert("Pedido realizado con éxito.");
                        localStorage.removeItem("carrito");
                        cargarCarrito();
                    }
                } catch (error) {
                    console.error("Error al parsear JSON:", texto);
                }
            })
            .catch((error) => console.error("Error al realizar el pedido:", error)); 
    });
});
