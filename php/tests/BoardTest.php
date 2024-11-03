<?php
namespace App\Models;

use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase {
    public function testInicializarTablero() {
        $tablero = new Board();
        $this->assertCount(Board::FILES, $tablero->getSlots()); 
        $this->assertCount(Board::COLUMNS, $tablero->getSlots()[1]); 
    }

    public function testMovimientoValido() {
        $tablero = new Board();
        $this->assertTrue($tablero->isValidMove(1)); // La columna 1 debe ser válida al inicio
        $tablero->setMovementOnBoard(0, 1);
        $this->assertFalse($tablero->isValidMove(0)); // La columna 1 no debe ser válida después de un movimiento
    }

    public function testColocarFicha() {
        $tablero = new Board();
        $resultado = $tablero->setMovementOnBoard(1, 1);
        $this->assertEquals([6, 1], $resultado); 
        $this->assertEquals(1, $tablero->getSlots()[6][1]);
    }
    
    public function testComprobarVictoria() {
        $tablero = new Board();
        $tablero->setMovementOnBoard(1, 1);
        $tablero->setMovementOnBoard(2, 1);
        $tablero->setMovementOnBoard(3, 1);
        $tablero->setMovementOnBoard(4, 1);
        $this->assertTrue($tablero->checkWin([1, 1])); // Debe haber una victoria horizontal
    }

    public function testTableroLleno() {
        $tablero = new Board();
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            for ($row = 1; $row <= Board::FILES; $row++) {
                $tablero->setMovementOnBoard($col, 1);
            }
        }
        $this->assertTrue($tablero->isFull()); // El tablero debe estar lleno
    }
}
?>
