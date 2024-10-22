<?php  
session_start();
if (!isset($_SESSION["user"])) {
    header("Locati: ../auth.php");
    exit();
}
require_once 'funciones.php';
const PALABRA = "saludar";
const INTENTOS_MAXIMOS = 6;
$data = inicarVariables();

if (isset($_SESSION['ahorcado'])) {
    $data = json_decode($_SESSION['ahorcado'], true);
}else{
    $_SESSION['ahorcado'] = json_encode($data);
}

$mensaje = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        $data = inicarVariables();
    }else {
        $letra = isset($_POST['letra']) ? strtolower(htmlspecialchars($_POST['letra'])) : '';

        
        if ($data["intentos"] > 0) {
        
            if ($letra === '' || strlen($letra) !== 1) {
                $mensaje[] = ["incorrect" => "Introduce una letra"];
            } elseif (array_key_exists($letra, $data["letrasUsadas"])) {
                $mensaje[] = ["incorrect" => "Letra ya usada"];
            } elseif(ponerLetra($letra, $data["letras"])){
                $data["letrasUsadas"][$letra] = "correct";
            }else{
                $data["letrasUsadas"][$letra] = "incorrect";
                $data["intentos"]--;
            }

            
            if (implode('', $data["letras"]) === PALABRA) {
                $mensaje[] = ["correct" => "Has ganado"];
            }
        }
        
        if ($data["intentos"] <= 0) {
            $mensaje[] = ["incorrect" => "Has perdido"];
        } 

    }
    $_SESSION['ahorcado'] = json_encode($data);
    // header('Location: /ahorcado/ahorcado.php');
    // exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="../public/estilo.css">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <a href="http://localhost/index.php"><h1>Ahorcado</h1></a>
    </header>    
    <main>

        <form action="" method="post">
            <h1 id="palabra">Palabra<br><?= implode(' ',$data["letras"]) ?></h1>
            <label for="letra">Introduce una letra:</label>
            <input type="text" name="letra" id="letra" maxlength="1" minlength="1" autocomplete="off" autofocus required>
            <button>Enviar</button>
            <button id="resetButton" name="reset" value="true">Resert</button>
        </form>
        <section>
            <article>
                <h1>Letras Usadas:</h1>
                <p id="letras">
                    <?php
                        foreach ($data["letrasUsadas"] as $key => $valor) {
                        echo "<span class='$valor'>$key</span>";
                    }
                    ?>
                </p>
            </article>
            <article>
                <h1>Intentos:</h1>
                <p><?= $data["intentos"]?></p>
                <h1>Mensajes:</h1>
                <p>
                    <?php
                        foreach ($mensaje as $key => $valor) {
                        echo "<span class='".key($valor)."'>".current($valor)."</span>";
                    }
                    ?>
                </p>
            </article>
        </section>
    </main>
    <footer>
        <p>S.A - 3 CIP FP Batoi  Jordi Gisbert Ferriz</p>
    </footer>
    <script>
    document.getElementById('resetButton').addEventListener('click', function(event) {
        // Desactivar el atributo required temporalmente
        document.getElementById('letra').removeAttribute('required');
    });
</script>
</body>
</html>
