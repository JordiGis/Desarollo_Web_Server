<?php  


function ponerLetra($letra, &$letras) {
    for ($i=0; $i < strlen(PALABRA); $i++) { 
        if (substr(PALABRA,$i,1) == $letra) {
            $letras[$i] = $letra;
            return true;
        }
    }
    return false;
}

?>