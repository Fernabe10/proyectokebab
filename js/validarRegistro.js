document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        
        const errorLabels = form.querySelectorAll(".claseErrores");
        errorLabels.forEach((label) => (label.textContent = ""));

        // validación de la foto
        const fotoInput = form.querySelector("input[name='foto']");
        const fotoErrorLabel = fotoInput.nextElementSibling;
        if (!fotoInput.files || fotoInput.files.length === 0) {
            isValid = false;
            fotoErrorLabel.textContent = "Debe seleccionar una foto.";
        }

        // validación del nombre
        const nombreInput = form.querySelector("input[name='nombre']");
        const nombreErrorLabel = nombreInput.nextElementSibling;
        if (nombreInput.value.trim().length < 3) {
            isValid = false;
            nombreErrorLabel.textContent = "El nombre debe tener al menos 3 caracteres.";
        }

        // validación de la contraseña
        const contrasenaInput = form.querySelector("input[name='contrasena']");
        const contrasenaErrorLabel = contrasenaInput.nextElementSibling;
        if (contrasenaInput.value.trim().length < 6) {
            isValid = false;
            contrasenaErrorLabel.textContent = "La contraseña debe tener al menos 6 caracteres.";
        }

        // Validación del correo
        const correoInput = form.querySelector("input[name='correo']");
        const correoErrorLabel = correoInput.nextElementSibling;
        const correoPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!correoPattern.test(correoInput.value.trim())) {
            isValid = false;
            correoErrorLabel.textContent = "Debe ingresar un correo electrónico válido.";
        }

        // validación de la dirección (opcional)
        const direccionInput = form.querySelector("input[name='direccion']");
        const direccionErrorLabel = direccionInput.nextElementSibling;
        if (direccionInput.value.trim().length > 0 && direccionInput.value.trim().length < 5) {
            isValid = false;
            direccionErrorLabel.textContent = "Si proporciona una dirección, debe tener al menos 5 caracteres.";
        }

        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
