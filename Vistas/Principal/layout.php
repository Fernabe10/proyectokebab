<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda Online Kebabs</title>
    <link rel="stylesheet" href="css/estilo-header.css">
    <link rel="stylesheet" href="css/estilo-footer.css">
    <link rel="stylesheet" href="css/estilo-landing-page.css">
    

</head>
<body>
    <?php
        require_once 'header.php';
    ?>
    <section>
        <div id="cuerpo">
        <?php
           require_once 'enruta.php';
        ?>
        </div>
    </section>

    <?php
        require_once 'footer.php';
    ?>

</body>