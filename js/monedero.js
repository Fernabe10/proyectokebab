window.addEventListener("load", function () {
    const saldoSpan = document.getElementById("saldo"); // Elemento para mostrar el saldo

    traerSaldo();

    // Función para traer el saldo
    function traerSaldo() {
        var peticion = new Request("Api/Api-Monedero.php", {
            method: "GET",
        });
    
        fetch(peticion)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta de la API");
                }
                return response.json();
            })
            .then(data => {
                const saldoSpan = document.getElementById("saldo");
                if (data.success) {
                    saldoSpan.textContent = `${data.monedero.toFixed(2)} €`;
                } else {
                    saldoSpan.textContent = "Error al cargar saldo";
                    console.error("Error desde la API:", data.message, data.debug || "Sin datos adicionales");
                }
            })
            .catch(error => {
                const saldoSpan = document.getElementById("saldo");
                saldoSpan.textContent = "Error al cargar saldo";
                console.error("Error de red o en el fetch:", error.message);
            });
    }
    
    

    // Función para manejar la recarga del saldo
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado

        const formData = new FormData(form);

        fetch("Api/Api-Monedero.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error al recargar saldo");
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    alert(data.message);
                    traerSaldo(); // Actualizar el saldo después de recargar
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch((error) => {
                console.error(error);
                alert("Error al recargar saldo");
            });
    });

     // Cargar el saldo al cargar la página
});
