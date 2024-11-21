    window.addEventListener("load", function() {
        rellenarKebabs();

        function rellenarKebabs() {
            var peticion = new Request("Api/ApiKebab.php", {
                method: "GET"
            });
    
            fetch(peticion)
                .then(function (respuesta) {
                    return respuesta.json();
                })
                .then(function (kebabs) {
                    const tablaCuerpo = document.getElementById("nombres");
    
                    kebabs.forEach(function (kebab) {
                        const fila = document.createElement("tr");
    
                        const celdaId = document.createElement("td");
                        celdaId.textContent = kebab.id;
    
                        const celdaNombre = document.createElement("td");
                        celdaNombre.textContent = kebab.nombre;
    
                        const celdaDescripcion = document.createElement("td");
                        celdaDescripcion.textContent = kebab.descripcion;
    
                        const celdaPrecio = document.createElement("td");
                        celdaPrecio.textContent = `${kebab.precio}€`;
    
                        const celdaIngredientes = document.createElement("td");
                        const listaIngredientes = document.createElement("ul");
    
                        
                        kebab.ingredientes.forEach(function (ingrediente) {
                            const item = document.createElement("li");
                            item.textContent = ingrediente; 
                            listaIngredientes.appendChild(item); 
                        });
    
                        celdaIngredientes.appendChild(listaIngredientes);
    
                        const celdaFoto = document.createElement("td");
                        const imagen = document.createElement("img");
                        imagen.src = `data:image/jpeg;base64,${kebab.foto}`;
                        imagen.alt = `Foto de ${kebab.nombre}`;
                        imagen.style.width = "100px";
                        celdaFoto.appendChild(imagen);
    
                        fila.appendChild(celdaId);
                        fila.appendChild(celdaNombre);
                        fila.appendChild(celdaDescripcion);
                        fila.appendChild(celdaPrecio);
                        fila.appendChild(celdaIngredientes);
                        fila.appendChild(celdaFoto);
    
                        tablaCuerpo.appendChild(fila);
    
                        fila.addEventListener("dblclick", function () {
                            activarEdicion(); //FUNCION PARA ACTIVAR LA EDICION DE LA TABLA
                        });
                    });
                })
                .catch(function (error) {
                    console.error("Error al cargar los datos de los kebabs:", error);
                });
        }
    });
