document.getElementById("formKebabPersonalizado").addEventListener("submit", function (e) {
    e.preventDefault(); // Evita la recarga de la página

    // Captura los datos del formulario
    const nombre = document.getElementById("nombre").value;
    const descripcion = document.getElementById("descripcion").value;
    const ingredientesSeleccionados = JSON.parse(document.getElementById("ingredientesSeleccionadosInput").value);

    // Calcula el precio basado en los ingredientes
    const precioBase = 5; // Precio base del kebab personalizado
    const precioPorIngrediente = 0.5;
    const precioTotal = precioBase + ingredientesSeleccionados.length * precioPorIngrediente;

    // Agrega el kebab personalizado al carrito
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    carrito.push({
        nombre,
        descripcion,
        ingredientes: ingredientesSeleccionados,
        precio_total: precioTotal,
        cantidad: 1,
        tipo: "personalizado", // Marca este item como "personalizado"
    });

    // Guarda el carrito actualizado en localStorage
    localStorage.setItem("carrito", JSON.stringify(carrito));

    // Muestra un mensaje de confirmación
    alert("¡Kebab personalizado añadido al carrito!");
});
