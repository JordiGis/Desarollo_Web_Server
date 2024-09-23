<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <label>
            Nombre:
            <input type="text" name="nombre">
        </label>
        <label>
            Correo:
            <input type="email" name="email">
        </label>
        <label>
            Edad:
            <input type="number" name="edad">
        </label>
        <button>Enviar</button>

    </form>


    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $edad = $_POST["edad"];

            if (empty($nombre) || empty($email) || empty($edad)) {
                echo "<h1>Por favor, rellena todos los campos</h1>";
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<h1>El email no es válido</h1>";
                return;
            }
            ?>       
                <h1>Información recibida</h1>
                <p>Nombre: <?=$nombre?></p>
                <p>Email: <?=$email?></p>
                <p>Edad: <?=$edad?></p>
            <?php

        } 
        
        ?>
    
</body>
</html>