<?php
const COLUMNAS = 7;
const FILAS = 6;
$tabla = iniciarTabla();
function iniciarTabla()
{
    $tabla = [];
    for ($i = 0; $i < COLUMNAS; $i++) {
        $tabla[] = [];
        for ($j = 0; $j < FILAS; $j++) {
            $tabla[$i][] = "buid";
        }
    }
    return $tabla;
}

function printarTabla($tabla)
{
    ?>
    <form action="" method="post">
        <table border="1">
            <tbody>
                <tr>
                    <?php
                    for ($i = 0; $i < COLUMNAS; $i++) {
                        echo "<th><button type='submit' name='columna' value=$i>Columna $i</button></th>";
                    }
                    ?>
                </tr>
                <?php
                $filas = FILAS - 1;
                for ($row = $filas; $row >= 0; $row--) {
                    echo "<tr>";
                    for ($col = 0; $col < COLUMNAS; $col++) {
                        echo "<td class='".$tabla[$col][$row]."'></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <label>
            Jugador 1
            <input type="radio" name="personaje" value="player1" checked>
        </label>
        <label>
            Jugador 2
            <input type="radio" name="personaje" value="player2">
        </label>
        <input type="text" hidden name="tabla" value='<?= json_encode($tabla)?>'>
    </form>
    <?php

}

function movimiento(&$tabla, $columna, $jugador)
{
    for ($i = 0; $i < FILAS; $i++) {
        if ($tabla[$columna][$i] == "buid") {
            $tabla[$columna][$i] = $jugador;
            return true;
        }
    }
    return false;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['tabla'])) {
        $tabla = json_decode($_POST['tabla']);
    }

    if (isset($_POST['columna']) && $_POST['columna'] != "" && isset($_POST['personaje'])) {
        $columna = htmlspecialchars($_POST['columna']);
        if ($columna < 0 || $columna >= COLUMNAS) {
            echo "Columna no valida";
        }

        if (!movimiento($tabla, $columna, htmlspecialchars($_POST['personaje']))) {
            echo "Columna llena";
        }
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
    <?php printarTabla($tabla); ?>
</body>

</html>