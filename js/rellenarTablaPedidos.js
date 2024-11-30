window.addEventListener("load", function () {
    rellenarPedidos();

    function rellenarPedidos() {
        fetch("Api/ApiPedido.php", { method: "GET" })
            .then(response => response.json())
            .then(pedidos => {
                const tablaCuerpo = document.querySelector("table tbody");

                // Limpiar el contenido de la tabla
                tablaCuerpo.innerHTML = "";

                // Mostrar mensaje si no hay pedidos
                if (pedidos.length === 0) {
                    const filaVacia = document.createElement("tr");
                    filaVacia.innerHTML = `<td colspan="8">No hay pedidos registrados.</td>`;
                    tablaCuerpo.appendChild(filaVacia);
                    return;
                }

                // Crear filas para cada pedido
                pedidos.forEach(pedido => {
                    const fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${pedido.id}</td>
                        <td>${pedido.id_usuario}</td>
                        <td>${pedido.nombre}</td>
                        <td>€${pedido.precio_total}</td>
                        <td>${pedido.cantidad}</td>
                        <td>${pedido.fecha_hora}</td>
                        <td>
                            <select class="estado-pedido" data-id="${pedido.id}">
                                <option value="Recibido" ${pedido.estado === 'Recibido' ? 'selected' : ''}>Recibido</option>
                                <option value="En preparación" ${pedido.estado === 'En preparación' ? 'selected' : ''}>En preparación</option>
                                <option value="Enviado" ${pedido.estado === 'Enviado' ? 'selected' : ''}>Enviado</option>
                                <option value="Completado" ${pedido.estado === 'Completado' ? 'selected' : ''}>Completado</option>
                            </select>
                        </td>
                        <td>${pedido.direccion}</td>
                    `;

                    tablaCuerpo.appendChild(fila);
                });

                // Agregar evento a los selects
                const selectsEstado = document.querySelectorAll(".estado-pedido");
                selectsEstado.forEach(select => {
                    select.addEventListener("change", function () {
                        const idPedido = this.dataset.id;
                        const nuevoEstado = this.value;

                        cambiarEstadoPedido(idPedido, nuevoEstado);
                    });
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

    function cambiarEstadoPedido(id, nuevoEstado) {
        fetch("Api/ApiPedido.php", {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: id, estado: nuevoEstado })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Estado del pedido actualizado correctamente.");
                } else {
                    alert("Error al actualizar el estado del pedido.");
                }
            })
            .catch(error => {
                console.error("Error al actualizar el estado del pedido:", error);
                alert("Error inesperado al intentar actualizar el estado.");
            });
    }
});
