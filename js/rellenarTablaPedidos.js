window.addEventListener("load", function () {
    rellenarPedidos();

    function rellenarPedidos() {
        fetch("Api/ApiPedido.php", { method: "GET" })
            .then(response => response.json())
            .then(pedidos => {
                const tablaCuerpo = document.querySelector("table tbody");

                // Limpiar el cuerpo de la tabla
                tablaCuerpo.innerHTML = "";

                // Verificar si hay pedidos
                if (pedidos.length === 0) {
                    const filaVacia = document.createElement("tr");
                    filaVacia.innerHTML = `<td colspan="8">No hay pedidos registrados.</td>`;
                    tablaCuerpo.appendChild(filaVacia);
                    return;
                }

                // Agregar los pedidos a la tabla
                pedidos.forEach(pedido => {
                    const fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${pedido.id}</td>
                        <td>${pedido.id_usuario}</td>
                        <td>${pedido.nombre}</td>
                        <td>€${pedido.precio_total}</td>
                        <td>${pedido.cantidad}</td>
                        <td>${pedido.fecha_hora}</td>
                        <td>${pedido.estado}</td>
                        <td>${pedido.direccion}</td>
                    `;

                    tablaCuerpo.appendChild(fila);
                });
            })
            .catch(error => {
                console.error("Error al cargar los pedidos:", error);

                const tablaCuerpo = document.querySelector("table tbody");
                tablaCuerpo.innerHTML = `
                    <tr>
                        <td colspan="8">Error al cargar los pedidos. Intenta nuevamente más tarde.</td>
                    </tr>
                `;
            });
    }
});
