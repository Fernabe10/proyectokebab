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
                        <img src="data:image/jpeg;base64,${kebab.foto}" alt="Foto de ${kebab.nombre}">
                        <h2>${kebab.nombre}</h2>
                        <p>${kebab.descripcion}</p>
                        <p>Ingredientes:</p>
                        <span>€${kebab.precio}</span>
                        <button>Pedir</button>
                        <button>Personalizar</button>
                    `;
                    kebabContainer.appendChild(kebabCard);
                });
            })
            .catch((error) => {
                console.error("Error al cargar los kebabs:", error);
            });
    }
});
