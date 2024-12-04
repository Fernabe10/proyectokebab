window.addEventListener("load", function () {
    cargarKebabs();

    function cargarKebabs() {
        fetch("Api/ApiKebab.php")
            .then((respuesta) => respuesta.json())
            .then((kebabs) => {
                const kebabContainer = document.getElementById("kebabContainer");

                kebabs.forEach((kebab) => {
                    const cajaKebab = document.createElement("div");

                    let ingredientesList = "";
                    kebab.ingredientes.forEach((ingrediente) => {
                        ingredientesList += `<li>${ingrediente}</li>`;
                    });

                    cajaKebab.innerHTML = `
                        <img src="data:image/jpeg;base64,${kebab.foto}" alt="Foto de ${kebab.nombre}">
                        <h2>${kebab.nombre}</h2>
                        <p>${kebab.descripcion}</p>
                        <span>€${kebab.precio}</span>
                        <h3>Ingredientes:</h3>
                        <ul>${ingredientesList}</ul>
                        <h3>Alergenos:</h3>
                        <ul>${kebab.alergenos.map(a => `<li>${a}</li>`).join('')}</ul>
                        <div class="buttons-container">
                            <button class="pedir-button" data-id="${kebab.id}" data-nombre="${kebab.nombre}" data-precio="${kebab.precio}">Pedir</button>
                            <a href="?menu=personalizar&id=${kebab.id}" class="personalizar-button">Personalizar</a>
                        </div>

                        
                        `;

                    kebabContainer.appendChild(cajaKebab);
                });

                // Añadir eventos a los botones de "Pedir"
                document.querySelectorAll(".pedir-button").forEach((button) => {
                    button.addEventListener("click", function () {
                        const nombre = this.dataset.nombre;
                        const precio = parseFloat(this.dataset.precio);

                        hacerPedido(nombre, precio);
                    });
                });
            })
            .catch((error) => {
                console.error("Error al cargar los kebabs:", error);
            });
    }

    // Función que se ejecuta cuando se hace clic en el botón de "Pedir"
    
    function hacerPedido(nombre, precio) {
        // Verificar si el usuario está autenticado
        fetch("helpers/verificar_sesion.php")
            .then((respuesta) => respuesta.json())
            .then((data) => {
                if (!data.autenticado) {
                    alert("Para pedir es necesario iniciar sesión");
                    return;
                }
    
                
                const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
                const producto = carrito.find(item => item.nombre === nombre);
    
                if (producto) {
                    producto.cantidad++;
                    producto.precio_total = producto.cantidad * precio;
                } else {
                    carrito.push({ nombre, precio_total: precio, cantidad: 1 });
                }
    
                localStorage.setItem("carrito", JSON.stringify(carrito));
                alert("¡Producto añadido al carrito!");
            })
            .catch((error) => {
                console.error("Error al verificar la sesión:", error);
            });
    }
    
    
});
