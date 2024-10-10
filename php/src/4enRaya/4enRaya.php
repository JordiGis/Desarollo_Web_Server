<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../auth.php");
    exit();
}

if (!isset($_COOKIE["4enRaya"])) {
    header("Location: 4enRayaConf.php");
    exit();
}
$cookie = json_decode($_COOKIE["4enRaya"], true);
require_once 'funciones.php';

const COLUMNAS = 7;
const FILAS = 6;
$data = [
    'jugador' => 'player1',
    'contador' => ["player1" => 0, "player2" => 0],
    'tabla' => iniciarTabla(),
    'mensaje' => [],
];

if (isset($_POST['reiniciar']) && $_POST['reiniciar'] != "") {
    unset($_SESSION['4enRaya']);
}


if (isset($_SESSION['4enRaya'])) {
    $data = json_decode($_SESSION['4enRaya'], true);
} else {
    $_SESSION['4enRaya'] = json_encode($data, true);
}

$columna = -1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($data['finJuego'])) {
        if (isset($_POST['columna'])) {
            $columna = htmlspecialchars($_POST['columna']);
        }

        if ($columna < 0 || $columna >= COLUMNAS) {
            $menaje = "Columna no valida";
        }elseif (!movimiento($data["tabla"], $columna, $data['jugador'])) {
            $menaje = "Columna llena";
        } elseif (hayCuatroEnRaya($data["tabla"], COLUMNAS, FILAS, $data['jugador'])) {
            $data['mensaje'][] = "Ha ganado el jugador " . $cookie[$data['jugador']];
            $data['contador'][$data['jugador']]++;
            $data['finJuego'] = true;
        }else{
            cambiarJugador($data['jugador']);
        }
        
        $_SESSION['4enRaya'] = json_encode($data);
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 en Raya</title>
    <link rel="stylesheet" href="../public/estilo.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root{
            --color-player1: <?= $cookie["color1"] ?>;
            --color-player2: <?= $cookie["color2"] ?>;
        }
    </style>
</head>

<body>
    <header>
        <a href="http://localhost/index.php">
            <h1>4 en Raya</h1>
        </a>
    </header>
    <aside id="barra-lateral">
        <h2>4 en Raya</h2>
        <p>Turno del jugador: <span class="<?= ( $data['jugador'] === "player1")? 'textPlayer1': 'textPlayer2'?>"><?= $cookie[$data['jugador']]?></span></p>
        <h2>Contador</h2>
        <p><?= $cookie['player1'] .': '. $data['contador']['player1'] ?></p>
        <p><?= $cookie['player2'] .': '. $data['contador']['player2'] ?></p>
        <p><?php echo implode("<br>", $data['mensaje']); ?></p>
        <form action="" method="post" id="form-reiniciar">
            <button id="reiniciar" type="buton" name="reiniciar" value="reiniciar">Reiniciar</button>
        </form>
    </aside>
    <main>
        <?php printarTabla($data["tabla"]); ?>
    </main>
    <footer>
        <p>S.A - 3 CIP FP Batoi Jordi Gisbert Ferriz</p>
    </footer>
    <script>
        $(document).ready(function () {
            
            $('td').on('mouseenter', function () {
                const columnIndex = $(this).index();
                $(this).closest('table').find(`td:nth-child(${columnIndex + 1}), th:nth-child(${columnIndex + 1})`).addClass('highlight');
            });

            $('td').on('mouseleave', function () {
                const columnIndex = $(this).index(); // Obtener el índice de la columna
                $(this).closest('table').find(`td:nth-child(${columnIndex + 1}), th:nth-child(${columnIndex + 1})`).removeClass('highlight');
            });
            $('td').on('click', function () {
                const columnIndex = $(this).index() + 1;
                $('#tablero').append(`<input type="hidden" name="columna" value="${columnIndex -1 }">`);
                $('#tablero').submit();
                
            });

        });

        
    </script>
</body>

</html>