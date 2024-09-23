<?php
$opciones = ["azul", "rojo", "verde"];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <label for="fileUpload">Subir archivo:</label>
    <input type="file" id="fileUpload" name="archivo">
    
    <?php foreach ($opciones as $opcion) {
        ?>
    <label>
        <?= $opcion ?>
    <input type="checkbox" name="color" value="<?= $opcion?>">
    </label>
    <?php } ?>
    <button>Enviar</button>

    </form>
</body>
</html>