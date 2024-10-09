<?php  
function inicarVariables() {
    return ["letras" => inicarArray(), "letrasUsadas" => [], "intentos" => INTENTOS_MAXIMOS];
}
function inicarArray() {
    return array_fill(0, strlen(PALABRA), "_");;
}

function ponerLetra($letra, &$letras) {
    $encontrada = false;
    for ($i=0; $i < strlen(PALABRA); $i++) { 
        if (substr(PALABRA,$i,1) == $letra) {
            $letras[$i] = $letra;
            $encontrada =  true;
        }
    }
    return $encontrada;
}

?>