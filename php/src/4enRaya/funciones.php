<?php
if (!isset($_SESSION["user"])) {
    header("Location: ../auth.php");
    exit();
}

function iniciarTabla()
{
    return array_fill(0, COLUMNAS, array_fill(0, FILAS, "buid"));;
}

function printarTabla($tabla)
{
    ?>
    <form id="tablero" action="" method="post">
        <table border="1">
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



function hayCuatroEnRaya($tabla, $columnas, $filas, $ficha) {
    $direcciones = [
        [1, 0],  // Derecha
        [0, 1],  // Abajo
        [1, 1],  // Diagonal descendente (derecha-abajo)
        [1, -1]  // Diagonal ascendente (derecha-arriba)
    ];

    for ($col = 0; $col < $columnas; $col++) {
        for ($fila = 0; $fila < $filas; $fila++) {
            if ($tabla[$col][$fila] !== $ficha) {
                continue;
            }

            foreach ($direcciones as $direccion) {
                $dx = $direccion[0];
                $dy = $direccion[1];

                $espacioDisponible = true;
                for ($i = 1; $i < 4; $i++) {
                    $nuevoCol = $col + $i * $dx;
                    $nuevaFila = $fila + $i * $dy;

                    if ($nuevoCol < 0 || $nuevoCol >= $columnas || $nuevaFila < 0 || $nuevaFila >= $filas || $tabla[$nuevoCol][$nuevaFila] !== $ficha) {
                        $espacioDisponible = false;
                        break;
                    }
                }

                if ($espacioDisponible) {
                    return true;
                }
            }
        }
    }

    return false;
}

?>

