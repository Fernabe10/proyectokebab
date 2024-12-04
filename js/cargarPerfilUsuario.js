window.addEventListener("load", function () {
    cargarPerfil();

    function cargarPerfil() {
        const peticion = new Request("Api/ApiSesion.php", {
            method: "GET",
        });

        fetch(peticion)
            .then(function (respuesta) {
                if (!respuesta.ok) {
                    throw new Error("Error al obtener los datos del usuario.");
                }
                return respuesta.json();
            })
            .then(function(usuario) {
                
                const imagen = document.querySelector("#perfil-foto");
                
                if (usuario.foto) {
                    imagen.src = `data:image/jpeg;base64,${usuario.foto}`;
                } else {
                    console.error("La imagen no está disponible.");
                }
            
                
                document.querySelector("label[name='nombre']").textContent = usuario.nombre;
                document.querySelector("label[name='correo']").textContent = usuario.correo;
                document.querySelector("label[name='monedero']").textContent = `${usuario.monedero} €`;
                document.querySelector("label[name='direccion']").textContent = usuario.direccion;
            })
            .catch(function(error) {
                console.error("Error al cargar los datos del perfil:", error);
            });
    }
});
