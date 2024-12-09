window.addEventListener("load", function () {
    cargarAlergenos();

    function cargarAlergenos() {
        var peticion = new Request("Api/Api-Alergeno.php", {
            method: "GET",
        });

        fetch(peticion)
            .then(function (respuesta) {
                return respuesta.json();
            })
            .then(function (alergenos) {
                const tbody = document.getElementById("nombres");
                tbody.innerHTML = "";

                alergenos.forEach(function (alergeno) {
                    var tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td>${alergeno.nombre}</td>
                        <td><img src="data:image/jpeg;base64,${alergeno.foto}" alt="Foto de ${alergeno.nombre}" width="50"></td>
                    `;

                    tbody.appendChild(tr);
                });
            }) 
            .catch(function (error) {
                console.error("Error al cargar los alérgenos:", error);
            });
    }
});
