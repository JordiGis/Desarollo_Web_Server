<?php


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
            <thead>
                <tr>
                    <?php
                    for ($i = 0; $i < COLUMNAS; $i++) {
                        echo "<th><button type='submit' name='columna' value=$i>Columna $i</button></th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
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


function cambiarJugador(&$jugador)
{
    $jugador = ($jugador == "player1" )? "player2" : "player1";
}
?>