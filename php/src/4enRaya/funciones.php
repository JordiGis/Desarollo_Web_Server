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

?>