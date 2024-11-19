window.addEventListener("load", function () {
    cargarKebabs();

    function cargarKebabs() {
        fetch("Api/ApiKebab.php")
            .then((respuesta) => respuesta.json())
            .then((kebabs) => {
                const kebabContainer = document.getElementById("kebabContainer");

                kebabs.forEach((kebab) => {
                    const kebabCard = document.createElement("div");

                    kebabCard.innerHTML = `
                        <img src="${kebab.foto}" alt="${kebab.nombre}">
                        <h2>${kebab.nombre}</h2>
                        <p>${kebab.descripcion}</p>
                        <span>€${kebab.precio}</span>
                        <button>Ordenar ahora</button>
                    `;
                    kebabContainer.appendChild(kebabCard);
                });
            })
            .catch((error) => {
                console.error("Error al cargar los kebabs:", error);
            });
    }
});
