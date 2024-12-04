window.addEventListener("load", function () {
    rellenarPedidos();

    function rellenarPedidos() {
        fetch("Api/ApiPedidoUsuario.php", { method: "GET" })
            .then(response => response.json())
            .then(pedidos => {
                const tablaCuerpo = document.querySelector("table tbody");

                
                tablaCuerpo.innerHTML = "";

                
                if (pedidos.length === 0) {
                    const filaVacia = document.createElement("tr");
                    filaVacia.innerHTML = `<td colspan="8">No tienes pedidos registrados.</td>`;
                    tablaCuerpo.appendChild(filaVacia);
                    return;
                }

                
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