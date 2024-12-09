window.addEventListener("load", function () {
    cargarUsuarios();
    var edicion = false;
    const formulario = document.querySelector("#formulario");
    const tabla = document.getElementById("tabla");
    const botonCancelar = document.getElementById("cancelar");

    // Función para cargar los usuarios desde la API
    function cargarUsuarios() {
        var peticion = new Request("Api/ApiUser.php", {
            method: "GET"
        });

        fetch(peticion)
            .then(function (respuesta) {
                return respuesta.json();
            })
            .then(function (usuarios) {
                const tbody = document.getElementById("nombres");
                tbody.innerHTML = "";

                usuarios.forEach(function (usuario) {
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

                tbody.addEventListener("dblclick", function () {
                    editar();
                });

                function editar() {
                    if (edicion == false) {
                        edicion = true;

                        const filas = document.querySelectorAll("#nombres tr");

                        filas.forEach(function (fila) {
                            if (!fila.querySelector(".editar-btn")) {
                                var tdBotonEditar = document.createElement("td");
                                var botonEditar = document.createElement("button");
                                botonEditar.innerHTML = "Editar";

                                var tdBotonBorrar = document.createElement("td");
                                var botonBorrar = document.createElement('button');
                                botonBorrar.innerHTML = "Borrar";

                                botonEditar.addEventListener("click", function () {
                                    formulario.style.display = "flex";
                                    tabla.style.display = "none";

                                    // obtenemos los datos de la fila seleccionada
                                    const usuarioId = fila.cells[0].textContent;
                                    const usuarioNombre = fila.cells[1].textContent;
                                    const usuarioCorreo = fila.cells[2].textContent;
                                    const usuarioDireccion = fila.cells[3].textContent;
                                    const usuarioMonedero = fila.cells[4].textContent;
                                    const usuarioRol = fila.cells[5].textContent;
                                    const usuarioFoto = fila.cells[6].querySelector("img").src;
                                    const usuarioContrasena = "123456";

                                    // rellenamos el formulario con los datos obtenidos
                                    formulario.querySelector("input[name='id']").value = usuarioId;
                                    formulario.querySelector("input[name='nombre']").value = usuarioNombre;
                                    formulario.querySelector("input[name='email']").value = usuarioCorreo;
                                    formulario.querySelector("input[name='direccion']").value = usuarioDireccion;
                                    formulario.querySelector("input[name='monedero']").value = usuarioMonedero;
                                    formulario.querySelector("#roles").value = usuarioRol;
                                    document.getElementById("perfil-foto").src = usuarioFoto;
                                    formulario.querySelector("input[name='contrasena']").value = usuarioContrasena;  // No cargar la contraseña directamente
                                });

                                botonBorrar.addEventListener("click", function () {
                                    var usuarioId = fila.cells[0].textContent;
                                    borrarUsuario(usuarioId);
                                });

                                botonCancelar.addEventListener("click", function () {
                                    formulario.style.display = "none";
                                    tabla.style.display = "table";
                                    edicion = false;
                                });

                                tdBotonEditar.appendChild(botonEditar);
                                tdBotonBorrar.appendChild(botonBorrar);

                                fila.appendChild(tdBotonEditar);
                                fila.appendChild(tdBotonBorrar);
                            }
                        });
                    }
                }

                // Añadimos el manejador de envío del formulario
                formulario.addEventListener("submit", function (ev) {
                    ev.preventDefault();

                    // Obtener la foto del archivo seleccionado
                    const archivoFoto = formulario.querySelector("input[name='foto']").files[0];
                    let fotoBase64 = null;
                    if (archivoFoto) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            fotoBase64 = e.target.result;
                             // Eliminar el prefijo "data:image/jpeg;base64," o cualquier tipo de imagen
                            fotoBase64 = fotoBase64.replace(/^data:image\/[a-z]+;base64,/, '');
                            enviarDatos(fotoBase64);
                        };
                        reader.readAsDataURL(archivoFoto);
                    } else {
                        enviarDatos(null); // Si no se selecciona una foto, enviamos null
                    }

                    function enviarDatos(foto) {
                        // Obtenemos los datos del formulario
                        const datos = {
                            id: formulario.querySelector("input[name='id']").value,
                            nombre: formulario.querySelector("input[name='nombre']").value,
                            correo: formulario.querySelector("input[name='email']").value,
                            direccion: formulario.querySelector("input[name='direccion']").value,
                            monedero: formulario.querySelector("input[name='monedero']").value,
                            rol: formulario.querySelector("#roles").value,
                            foto: foto,
                            contrasena: formulario.querySelector("input[name='contrasena']").value
                        };

                        // Imprimir los datos a enviar
                        console.log("Datos a enviar:", datos);
                        console.log("JSON.stringify(datos):", JSON.stringify(datos));

                        // Realizamos la solicitud PUT
                        fetch("Api/ApiUser.php", {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json" // Asegúrate de que el contenido es JSON
                            },
                            body: JSON.stringify(datos) // Convertir el objeto JavaScript a un string JSON
                        })
                        .then(function (response) {
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error("Error al guardar el usuario.");
                            }
                        })
                        .then(function (respuesta) {
                            console.log("Usuario actualizado:", respuesta);
                            alert("Usuario actualizado correctamente.");
                            formulario.reset();
                            cargarUsuarios();
                            edicion = false;
                            formulario.style.display = "none";
                            tabla.style.display = "table";
                        })
                        .catch(function (error) {
                            console.error("Error al guardar el usuario:", error);
                            alert("Hubo un error al guardar el usuario.");
                        });
                    }
                });
            });
    }
});
