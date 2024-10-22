<?php  
namespace Joc4enRatlla\Models;

use Joc4enRatlla\Models\Player;

class Board
{
    public const FICHAS_PARA_GANAR = 4;
    public const FILES = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];
    public static const CLASE_VALOR_VACIO = "buid";
    private array $slots;

    public function __construct(){
        $this->slots = self::initializeBoard();
    }

    // Getters i Setters 
    public function getSlots(): array{
        return $this->slots;
    }

    public function setSlots(array $slots): void{
        $this->slots = $slots;
    }


    /**
     * Summary of initializeBoard
     * 
     * Inicialitza la tabla
     * 
     * @return string[][]
     */
    private static function initializeBoard(){
        return array_fill(0, self::COLUMNS, array_fill(0, self::FILES, self::CLASE_VALOR_VACIO));
    }

    /**
     * Summary of setMovementOnBoard
     * 
     * Realiza un movimiento en la tabla
     * 
     * @param int $column
     * @param \Joc4enRatlla\Models\Player $player
     * @return array
     */
    public function setMovementOnBoard(int $column, Player $player): array{
        for ($i = 0; $i < self::FILES; $i++) {
            if ($this->slots[$column][$i] == self::CLASE_VALOR_VACIO) {
                $this->slots[$column][$i] = $player;
                return [$column, $i];
            }
        }
        return [];
    }
    
    
    /**
     * Summary of checkWin
     * 
     * Comprueba si hay un ganador
     * 
     * @param array $coord
     * @return bool
     */
    public function checkWin(array $coord): bool
    {
        $x = $coord[0];
        $y = $coord[1];
        $player = $this->slots[$x][$y];
        foreach (self::DIRECTIONS as $direction) {
            $count = 1;
            foreach ($direction as $d) {
                $i = $x + $d;
                $j = $y + $d;
                while ($i >= 0 && $i < self::COLUMNS && $j >= 0 && $j < self::FILES && $this->slots[$i][$j] == $player) {
                    $count++;
                    $i += $d;
                    $j += $d;
                }
            }
            if ($count >= self::FICHAS_PARA_GANAR) {
                return true;
            }
        }
        return false;
    }
    
    
    /**
     * Summary of isValidMove
     * 
     * Comprueba si el movimiento es válido
     * 
     * @param int $column
     * @return bool
     */
    public function isValidMove(int $column): bool
    {
        return $column >= 0 && $column < self::COLUMNS && $this->slots[$column][self::FILES - 1] == self::CLASE_VALOR_VACIO;
    }

}

?>