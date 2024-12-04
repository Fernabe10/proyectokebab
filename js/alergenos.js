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
                
                selectAlergenos.innerHTML = "";

                
                alergenos.forEach(alergeno => {
                    let option = document.createElement("option");
                    option.value = alergeno.id;  
                    option.textContent = alergeno.nombre;  
                    selectAlergenos.appendChild(option);
                });
            })
            .catch(error => {
                console.error("Hubo un problema con la carga de alérgenos:", error);
            });
    }
});
