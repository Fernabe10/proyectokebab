document.getElementById("formKebabPersonalizado").addEventListener("submit", function (e) {
    e.preventDefault(); 

    // primero verifico si el usuario ha iniciado sesión
    fetch("helpers/verificar_sesion.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.autenticado == false) {
                alert("Para pedir un kebab personalizado es necesario iniciar sesión.");
                return;
            }

            const nombre = document.getElementById("nombre").value;
            const descripcion = document.getElementById("descripcion").value;
            const ingredientesSeleccionados = JSON.parse(
                document.getElementById("ingredientesSeleccionadosInput").value
            );

            
            const precioBase = 5; // le doy un precio base por ahora
            const precioPorIngrediente = 0.5;
            const precioTotal = precioBase + ingredientesSeleccionados.length * precioPorIngrediente;

            // agrego el kebab personalizado al carrito
            const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
            carrito.push({
                nombre,
                descripcion,
                ingredientes: ingredientesSeleccionados,
                precio_total: precioTotal,
                cantidad: 1,
                tipo: "personalizado",
            });

            
            localStorage.setItem("carrito", JSON.stringify(carrito));

            // Muestra un mensaje de confirmación
            alert("¡Kebab personalizado añadido al carrito!");
        })
        .catch((error) => {
            console.error("Error al verificar la sesión:", error);
        });
});
