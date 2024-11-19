window.addEventListener("load", function () {
    cargarIngredientes();

    function cargarIngredientes() {
        fetch("Api/Api-Ingrediente.php")
            .then((respuesta) => respuesta.json())
            .then((ingredientes) => {
                const contenedor3 = document.getElementById("contenedor3");
                const ingredientesSeleccionadosInput = document.getElementById("ingredientesSeleccionadosInput");

                
                ingredientes.forEach((ingrediente) => {
                    const label = document.createElement("label");
                    label.className = "ingrediente-disponible";
                    label.style.display = "block";

                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.value = ingrediente.nombre;

                    
                    checkbox.addEventListener("change", actualizarSeleccionados);

                    
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(ingrediente.nombre));

                    
                    contenedor3.appendChild(label);
                });

                
                function actualizarSeleccionados() {
                    const seleccionados = Array.from(document.querySelectorAll(".ingrediente-disponible input:checked"))
                        .map((checkbox) => checkbox.value);
                    ingredientesSeleccionadosInput.value = JSON.stringify(seleccionados);
                }
            })
            .catch((error) => {
                console.error("Error al cargar los ingredientes:", error);
            });
    }
});
