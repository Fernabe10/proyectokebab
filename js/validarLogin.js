window.addEventListener("load", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        
        const errorLabels = form.querySelectorAll(".claseErrores");
        errorLabels.forEach((label) => (label.textContent = ""));

        // validación de la contraseña
        const passwordInput = form.querySelector("input[name='password']");
        const passwordErrorLabel = passwordInput.nextElementSibling;
        if (passwordInput.value.trim().length < 6) {
            isValid = false;
            passwordErrorLabel.textContent = "La contraseña debe tener al menos 6 caracteres.";
        }

        // validación del correo
        const emailInput = form.querySelector("input[name='email']");
        const emailErrorLabel = emailInput.nextElementSibling;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            isValid = false;
            emailErrorLabel.textContent = "Debe ingresar un correo electrónico válido.";
        }

        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
