<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../auth.php");
    exit();
}

const COLORES = [
    'red',
    'blue',
    'green',
    'yellow',
    'orange',
    'purple',
    'pink',
    'brown',
    'cyan',
    'magenta'
];

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["jugador1"]) && isset($_POST["jugador2"]) && isset($_POST["color1"]) && isset($_POST["color2"])) {
        $jugador1 = $_POST["jugador1"];
        $jugador2 = $_POST["jugador2"];
        $color1 = $_POST["color1"];
        $color2 = $_POST["color2"];

        if ($jugador1 == $jugador2) {
            $errores[] = "Los jugadores no pueden tener el mismo nombre";
        }

        if ($color1 == $color2) {
            $errores[] = "Los jugadores no pueden tener el mismo color";
        }
        
        // Guardar los datos en la cookie si hay errores
        if (!empty($errores)) {
            $errorModalMessage = implode('<br>', $errores); // Convertir errores a cadena
        } else {
            setcookie("4enRaya", json_encode([
                "player1" => $jugador1,
                "player2" => $jugador2,
                "color1" => $color1,
                "color2" => $color2
            ]), time() + 3600);
            // Redirigir si no hay errores
            header("Location: 4enRaya.php"); // Cambia esto a la página que desees
            exit();
        }
    }
}

// Verificar si la cookie ya está establecida
$data = isset($_COOKIE["4enRaya"]) ? json_decode($_COOKIE["4enRaya"], true) : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion 4 en Raya</title>
    <link rel="stylesheet" href="../public/estilo.css">
    <link rel="stylesheet" href="../public/modal-error/estilo.css">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body>
    <header>
        <a href="http://localhost/index.php"><h1>Configuracion 4 en Raya</h1></a>
    </header>
    <main id="app">
        <form action="" method="post">
            <h1>Jugadores</h1>
            <section>
                <article>
                    <label for="jugador1">Jugador 1</label>
                    <input type="text" id="jugador1" name="jugador1" value="<?= $datosJuego['jugador1'] ?? '' ?>" autofocus
                        :style="{ backgroundColor: color1 }">
                    <select name="color1" v-model="color1">
                        <option v-for="color in colores" :key="color" :value="color">{{ color }}</option>
                    </select>
                </article>
                <article>
                    <label for="jugador2">Jugador 2</label>
                    <input type="text" id="jugador2" name="jugador2" value="<?= $datosJuego['jugador2'] ?? '' ?>"
                        :style="{ backgroundColor: color2 }">
                    <select name="color2" v-model="color2">
                        <option v-for="color in colores" 
                                :key="color" 
                                :value="color" 
                                :disabled="color === color1">{{ color }}</option>
                    </select>
                </article>
            </section>
            <button type="submit" id="guardar" name="action" value="guardar">Guardar</button>
        </form>
        <modal-error ref="errorModal"></modal-error>
    </main>
    <footer>
        <p>S.A - 3 CIP FP Batoi  Jordi Gisbert Ferriz</p>
    </footer>

    <script src="../public/modal-error/modal.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                colores: <?= json_encode(COLORES) ?>,
                color1: '<?= $data['color1'] ?? '' ?>',
                color2: '<?= $data['color2'] ?? '' ?>',
                errorMessage: '<?= isset($errorModalMessage) ? htmlspecialchars($errorModalMessage) : '' ?>',
            },
            mounted() {
                // Si hay un mensaje de error, abrir el modal
                if (this.errorMessage) {
                    this.$refs.errorModal.openModal(this.errorMessage);
                }
            }
        });
    </script>
</body>
</html>
