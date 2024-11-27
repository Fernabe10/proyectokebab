window.addEventListener("load", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const kebabId = urlParams.get("id");

    if (kebabId) {
        cargarKebabYIngredientes(kebabId);
    } else {
        mostrarError("No se ha especificado el ID del kebab.");
    }

    function cargarKebabYIngredientes(kebabId) {
        fetch(`Api/ApiKebab.php?id=${kebabId}`)
            .then((respuesta) => {
                if (!respuesta.ok) {
                    throw new Error("Error al cargar el kebab de la API.");
                }
                return respuesta.json();
            })
            .then((data) => {
                if (data.id) {
                    document.getElementById("nombre").textContent = data.nombre;
                    document.getElementById("descripcion").textContent = data.descripcion;
                    document.getElementById("precio").textContent = `${data.precio}€`;
                    document.getElementById("fotokebab").src = `data:image/jpeg;base64,${data.foto}`;

                    cargarIngredientes(data.ingredientesDelKebab);
                } else {
                    mostrarError("Kebab no encontrado en la base de datos.");
                }
            })
            .catch((error) => {
                mostrarError("Error al cargar los datos del kebab: " + error.message);
            });
    }

    function cargarIngredientes(ingredientesDelKebab) {
        fetch("Api/Api-Ingrediente.php")
            .then((respuesta) => {
                if (!respuesta.ok) {
                    throw new Error("Error al cargar los ingredientes de la API.");
                }
                return respuesta.json();
            })
            .then((ingredientes) => {
                const contenedor3 = document.getElementById("contenedor3");
                const idsIngredientesDelKebab = ingredientesDelKebab.map((i) => i.id);

                ingredientes.forEach((ingrediente) => {
                    const label = document.createElement("label");
                    label.className = "ingrediente-disponible";
                    label.style.display = "block";

                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.value = ingrediente.nombre;

                    if (idsIngredientesDelKebab.includes(ingrediente.id)) {
                        checkbox.checked = true;
                    }

                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(ingrediente.nombre));
                    contenedor3.appendChild(label);
                });
            })
            .catch((error) => {
                mostrarError("Error al cargar los ingredientes: " + error.message);
            });
    }

    const form = document.getElementById("formKebabPersonalizado");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        guardarKebabPersonalizadoEnCarrito();
    });

    function guardarKebabPersonalizadoEnCarrito() {
        try {
            const nombre = document.getElementById("nombre").textContent;
            const precio = parseFloat(document.getElementById("precio").textContent.replace("€", ""));
            const checkboxes = document.querySelectorAll("#contenedor3 input[type='checkbox']");

            
            const ingredientesSeleccionados = Array.from(checkboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);

            if (!nombre || isNaN(precio)) {
                throw new Error("Información del kebab incompleta. No se puede procesar el pedido.");
            }

            if (ingredientesSeleccionados.length === 0) {
                throw new Error("Por favor, selecciona al menos un ingrediente.");
            }

            const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

            const kebabExistente = carrito.find(
                (item) =>
                    item.nombre === nombre &&
                    JSON.stringify(item.ingredientes) === JSON.stringify(ingredientesSeleccionados)
            );

            if (kebabExistente) {
                kebabExistente.cantidad++;
                kebabExistente.precio_total = kebabExistente.cantidad * precio;
            } else {
                carrito.push({
                    nombre,
                    precio_total: precio,
                    cantidad: 1,
                    ingredientes: ingredientesSeleccionados,
                });
            }

            localStorage.setItem("carrito", JSON.stringify(carrito));
            alert("¡Kebab personalizado añadido al carrito!");
        } catch (error) {
            mostrarError(error.message);
        }
    }

    function mostrarError(mensaje) {
        console.error(mensaje);
        alert("Error: " + mensaje);
    }
});
