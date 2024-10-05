<?php
const COLUMNAS = 7;
const FILAS = 6;

require_once 'funciones.php';

// jugador por defecto
$jugador = "player1";
$tabla = iniciarTabla();
session_start();
if (isset($_SESSION['tabla'])) {
    $tabla = json_decode($_SESSION['tabla']);
}else{
    $_SESSION['tabla'] = json_encode($tabla);
}

if (isset($_SESSION['jugador'])) {
    $jugador = $_SESSION['jugador'];
}else{
    $_SESSION['jugador'] = $jugador;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['columna']) && $_POST['columna'] != "") {
        $columna = htmlspecialchars($_POST['columna']);
        if ($columna < 0 || $columna >= COLUMNAS) {
            echo "Columna no valida";
        }

        if (!movimiento($tabla, $columna, $jugador)) {
            echo "Columna llena";
        }else{
            cambiarJugador($jugador);
        }
        $_SESSION['jugador'] = $jugador;
        $_SESSION['tabla'] = json_encode($tabla);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;
        }

        td, th{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 10px dotted #fff;
            /* Cercle amb punts blancs */
            background-color: #000;
            /* Fons negre o pot ser un altre color */
            display: inline-block;
            margin: 10px;
        }

        .player1 {
            background-color: red;
            /* Color vermell per un dels jugadors */
        }

        .player2 {
            background-color: yellow;
            /* Color groc per l'altre jugador */
        }

        .buid {
            background-color: white;
            /* Color blanc per cercles buits */
            border-color: #000;
            /* Puntes negres per millor visibilitat */
        }
    </style>
</head>

<body>
    <?php printarTablaSesiones($tabla); ?>
</body>

</html>