<?php  
const PALABRA = "saludar";
$letras = [];
for ($i=0; $i < strlen(PALABRA); $i++) { 
    $letras[] = "_";
}
$mensaje = [];

function ponerLetra($letra, &$letras) {
    for ($i=0; $i < strlen(PALABRA); $i++) { 
        if (substr(PALABRA,$i,1) == $letra) {
            $letras[$i] = $letra;
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['letras'])) {
        $letras = explode(',',htmlspecialchars($_POST['letras']));
    }

    if (isset($_POST['letra']) && $_POST['letra'] != "") {
        $letra = strtolower(htmlspecialchars($_POST['letra']));
        $mensaje[] = (ponerLetra($letra, $letras))? ["correct" => "Letra: $letra correcta"] : ["incorrect" => "Letra: $letra incorrecta"];
    }else{
        $mensaje[] =  ["incorrect" => "Introduce una letra"];
    }

    if (implode('',$letras) == PALABRA) {
        $mensaje[] =  ["correct" => "Has ganado"];
        exit;
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form {
        display: flex;
        flex-direction: column;
        width: 200px;
    }
    .correct { color: green; }
    .incorrect { color: red; }

</style>
<body>
    <h1>Palabra</h1>
    <h2><?= implode(' ',$letras) ?></h2>
    <form action="" method="post">
        <label for="letra">Introduce una letra:</label>
        <input type="text" name="letra" id="letra" maxlength="1" minlength="1" autocomplete="off" autofocus required>
        <input type="submit" value="Enviar">
        <input hidden type="text" name="letras" value="<?= implode(',',$letras)  ?>">
    </form>
    <?php
    foreach ($mensaje as $value) {
        foreach ($value as $key => $valor) {
            echo "<p class='$key'>$valor</p>";
        }
    }
    ?>

</body>
</html>
