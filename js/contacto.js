window.addEventListener("load", function () {
    const form = document.getElementById('contactForm');
    const responseMessage = document.getElementById('responseMessage');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('Api/Api-Correo.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert("Mensaje enviado correctamente");
                form.reset();
            } else {
                alert("Error al enviar el mensaje");
            }
        })
        .catch(error => {
            responseMessage.innerHTML = `<p style="color: red;">Error inesperado al enviar el mensaje.</p>`;
            console.error('Error:', error);
        });
    });
});
