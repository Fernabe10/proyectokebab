window.addEventListener("load", function() {
    cargarUsuarios();

    function cargarUsuarios() {
        var peticion = new Request("Api/ApiUser.php", {
            method: "GET"
        });

        fetch(peticion)
            .then(function(respuesta) {
                return respuesta.json();
            })
            .then(function(usuarios) {
                const tbody = document.getElementById("nombres");
                tbody.innerHTML = "";

                usuarios.forEach(function(usuario) {
                    var tr = document.createElement("tr");

                    tr.innerHTML = `
                        <td>${usuario.id}</td>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.correo}</td>
                        <td>${usuario.direccion}</td>
                        <td>${usuario.monedero}</td>
                        <td>${usuario.rol}</td>
                        <td><img src="data:image/jpeg;base64,${usuario.foto}" alt="Foto de ${usuario.nombre}" width="50"></td>
                    `;

                    tbody.appendChild(tr);
                });

                tbody.addEventListener("dblclick", function() {
                    mostrarBotonesEditar();
                });
            })
            .catch(function(error) {
                console.error("Error al cargar usuarios:", error);
            });
    }

    function mostrarBotonesEditar() {
        const filas = document.querySelectorAll("#nombres tr");

        filas.forEach(function(fila) {
            if (!fila.querySelector(".editar-btn")) {
                var tdBotonEditar = document.createElement("td");
                var botonEditar = document.createElement("button");
                botonEditar.innerHTML = "Editar";

                var tdBotonBorrar = document.createElement("td");
                var botonBorrar = document.createElement('button');
                botonBorrar.innerHTML= "Borrar";

                var tdBotonGuardar = document.createElement("td");
                var botonGuardar = document.createElement('button');
                botonGuardar.innerHTML= "Guardar";

                botonEditar.addEventListener("click", function() {
                    var usuarioId = fila.cells[0].textContent;
                    editarUsuario(usuarioId);
                });

                botonBorrar.addEventListener("click",function(){
                    var usuarioId = fila.cells[0].textContent;
                    borrarUsuario(usuarioId);
                })

                tdBotonEditar.appendChild(botonEditar);
                tdBotonBorrar.appendChild(botonBorrar);
                tdBotonGuardar.appendChild(botonGuardar);
                fila.appendChild(tdBotonEditar);
                fila.appendChild(tdBotonBorrar);
                fila.appendChild(tdBotonGuardar);
            }
        });
    }


    function borrarUsuario(){
        
    }

    function editarUsuario(id) {
        console.log("Editar usuario con ID:", id);
    }
});
