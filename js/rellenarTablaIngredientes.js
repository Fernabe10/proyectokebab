window.addEventListener("load",function(){
    cargarIngredientes();

    function cargarIngredientes() {
        var peticion = new Request("Api/Api-Ingrediente.php", {
            method: "GET"
        });

        fetch(peticion)
            .then(function(respuesta) {
                return respuesta.json();
            })
            .then(function(ingredientes) {
                const tbody = document.getElementById("nombres");
                tbody.innerHTML = "";

                ingredientes.forEach(function(ingrediente) {
                    var tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td>${ingrediente.nombre}</td>
                        <td>${ingrediente.precio}</td>
                        <td>${ingrediente.descripcion}</td>
                        <td><img src="data:image/jpeg;base64,${ingrediente.foto}" alt="Foto de ${ingrediente.nombre}"></td>
                    `;

                    tbody.appendChild(tr);
                });

            })
            .catch(function(error) {
                console.error("Error al cargar usuarios:", error);
            });
    }

    
})