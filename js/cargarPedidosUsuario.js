window.addEventListener("load", function () {
    rellenarPedidos();

    function rellenarPedidos() {
        fetch("Api/ApiPedidoUsuario.php", { method: "GET" })
            .then(response => response.json())
            .then(pedidos => {
                const tablaCuerpo = document.querySelector("table tbody");

                // Limpiar el contenido de la tabla
                tablaCuerpo.innerHTML = "";

                // Mostrar mensaje si no hay pedidos
                if (pedidos.length === 0) {
                    const filaVacia = document.createElement("tr");
                    filaVacia.innerHTML = `<td colspan="8">No tienes pedidos registrados.</td>`;
                    tablaCuerpo.appendChild(filaVacia);
                    return;
                }

                // Crear filas para cada pedido
                pedidos.forEach(pedido => {
                    const fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${pedido.id}</td>
                        <td>${pedido.nombre}</td>
                        <td>€${pedido.precio_total}</td>
                        <td>${pedido.cantidad}</td>
                        <td>${pedido.fecha_hora}</td>
                        <td>${pedido.estado}</td>
                        <td>${pedido.direccion}</td>
                    `;

                    tablaCuerpo.appendChild(fila);
                });
            }

    )}
})