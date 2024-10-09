<?php
session_start();
require_once './utils/funciones.php';

const JUEGOS = [
    "ahorcado" =>  ["titulo" => "Ahorcado", "url" => "/ahorcado/ahorcado.php"],
    "4enRaya" =>  ["titulo" => "4 en Raya", "url" => "/4enRaya/4enRaya.php"],
];

if (isset($_POST["action"]) && $_POST["action"] == "salir") {
    logout();
    
}

if (!isset($_SESSION["user"])) {
    header("Location: auth.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificación</title>
    <link rel="stylesheet" href="./public/estilo.css">
    <link rel="stylesheet" href="./public/modal-error/estilo.css">
</head>
<body>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> -->
    <header>
        <h1>Juegos</h1>
    </header>
    <main>
        <form action="" method="post">
            <h1>Juegos Disponibles</h1>
            <?php  
            
            foreach (JUEGOS as $key => $value) {
                ?>  
                <a href="<?= $value['url'] ?>">
                    <button type='button' name='juego' value='<?= $key ?>'><?= $value["titulo"] ?></button>
                </a>
                <?php
            }
            ?>
            
            <button type="submit" id="salir" name="action" value="salir">Salir</button>
        </form>
    </main>
    <footer>
        <p>S.A - 3 CIP FP Batoi  Jordi Gisbert Ferriz</p>
    </footer>

    
</body>
</html>
