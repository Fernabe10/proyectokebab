window.addEventListener("load", function() {
    let selectAlergenos = document.getElementById("alergenos");

    cargarAlergenos();

    function cargarAlergenos() {
        var peticion = new Request("Api/Api-Alergeno.php", {
            method: "GET"
        });

        fetch(peticion)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al cargar los alérgenos");
                }
                return response.json();
            })
            .then(alergenos => {
                // Limpiar el select antes de llenarlo
                selectAlergenos.innerHTML = "";

                // Crear una opción por cada alérgeno recibido
                alergenos.forEach(alergeno => {
                    let option = document.createElement("option");
                    option.value = alergeno.id;  // La ID del alérgeno será el valor
                    option.textContent = alergeno.nombre;  // Se mostrará el nombre
                    selectAlergenos.appendChild(option);
                });
            })
            .catch(error => {
                console.error("Hubo un problema con la carga de alérgenos:", error);
            });
    }
});
