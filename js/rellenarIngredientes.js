window.addEventListener("load", function () {
    cargarIngredientes();

    function cargarIngredientes() {
        fetch("Api/Api-Ingrediente.php") // Ruta de la API para obtener los ingrediente
            .then((respuesta) => respuesta.json()) // Convertir la respuesta a JSON
            .then((ingredientes) => {
                const contenedor3 = document.getElementById("contenedor3"); // Contenedor donde se mostrarán los ingredientes
                const ingredientesSeleccionadosInput = document.getElementById("ingredientesSeleccionadosInput");

                // Recorrer cada ingrediente recibido y mostrarlo en el contenedor
                ingredientes.forEach((ingrediente) => {
                    const label = document.createElement("label"); // Crear un label para el ingrediente
                    label.className = "ingrediente-disponible"; // Asignar clase para estilos
                    label.style.display = "block"; // Mostrar cada ingrediente en una nueva línea

                    const checkbox = document.createElement("input"); // Crear un checkbox
                    checkbox.type = "checkbox"; // Tipo checkbox
                    checkbox.value = ingrediente.nombre; // Valor del checkbox será el nombre del ingrediente

                    // Evento para actualizar el campo oculto cuando se marca/desmarca un checkbox
                    checkbox.addEventListener("change", actualizarSeleccionados);

                    // Añadir el checkbox y el nombre del ingrediente al label
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(ingrediente.nombre));

                    // Añadir el label al contenedor
                    contenedor3.appendChild(label);
                });

                // Función para actualizar el input oculto con los seleccionados
                function actualizarSeleccionados() {
                    const seleccionados = Array.from(document.querySelectorAll(".ingrediente-disponible input:checked"))
                        .map((checkbox) => checkbox.value); // Obtener los valores de los checkbox marcados
                    ingredientesSeleccionadosInput.value = JSON.stringify(seleccionados); // Guardar como JSON
                }
            })
            .catch((error) => {
                console.error("Error al cargar los ingredientes:", error); // Manejar errores
            });
    }
});
