<?php  
namespace Joc4enRatlla\Models;


class Player {
    private $name;      // Nom del jugador
    private $color;     // Color de les fitxes
    private $isAutomatic; // Forma de jugar (automàtica/manual)

    public function __construct( $name, $color, $isAutomatic = false){}

    // Getters i Setters 
    public function getName(){
        return $this->name;
    }
    public function getColor(){
        return $this->color;
    }
    public function getIsAutomatic(){
        return $this->isAutomatic;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setColor($color){
        $this->color = $color;
    }
    public function setIsAutomatic($isAutomatic){
        $this->isAutomatic = $isAutomatic;
    }
    public function __toString(){
        return $this->name;
    }


}

?>