<head>
    <link rel="stylesheet" href="css/estilo-contacto.css">
    <script src="js/contacto.js"></script>
</head>

<body>
    <div id="container">
        <div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12613.456762217978!2d-3.7945344!3d37.781504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6dd71774e45867%3A0x99df1e0032930534!2sIES%20Fuentezuelas!5e0!3m2!1ses!2ses!4v1732215752853!5m2!1ses!2ses"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div>
            <h1>Contáctanos</h1>
            <form id="contactForm" action="Api/Api-Correo.php" method="POST">
                <label>Nombre</label>
                <input type="text" name="name" placeholder="Tu nombre" required>

                <label>Correo electrónico</label>
                <input type="email" name="email" placeholder="Tu correo electrónico" required>

                <label>Asunto</label>
                <select name="subject" required>
                    <option value="consulta">Consulta</option>
                    <option value="pedido">Pedido</option>
                    <option value="reclamacion">Reclamación</option>
                    <option value="otro">Otro</option>
                </select>

                <label>Mensaje</label>
                <textarea name="message" placeholder="Escribe tu mensaje aquí..." required></textarea>

                <input type="submit"></input>
            </form>

            <div id="responseMessage"></div>
        </div>
    </div>
</body>

