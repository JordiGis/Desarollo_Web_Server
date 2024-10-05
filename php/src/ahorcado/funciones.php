<?php  


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