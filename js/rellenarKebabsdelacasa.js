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
                        <h3>Alérgenos:</h3>
                        <div class="buttons-container">
                            <button>Pedir</button>
                            <button>Personalizar</button>
                        </div>
                    `;
                    kebabContainer.appendChild(cajaKebab);
                });
            })
            .catch((error) => {
                console.error("Error al cargar los kebabs:", error);
            });
    }
});