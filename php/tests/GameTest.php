<?php
namespace App\Models;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {
    public function testCrearJuego() {
        $jugador1 = new Player("Jugador 1", "red");
        $jugador2 = new Player("Jugador 2", "yellow");
        $juego = new Game($jugador1, $jugador2);
        
        $this->assertEquals($jugador1, $juego->getPlayers()[1]);
        $this->assertEquals($jugador2, $juego->getPlayers()[2]);
        $this->assertNull($juego->getWinner());
    }

    public function testJugarMovimiento() {
        $jugador1 = new Player("Jugador 1", "red");
        $jugador2 = new Player("Jugador 2", "yellow");
        $juego = new Game($jugador1, $jugador2);
        
        $juego->play(1);
        $this->assertNotNull($juego->getBoard()->getSlots()[6][1]);
    }

    public function testReiniciarJuego() {
        $jugador1 = new Player("Jugador 1", "red");
        $jugador2 = new Player("Jugador 2", "yellow");
        $juego = new Game($jugador1, $jugador2);
        
        $juego->play(1);
        $juego->reset();
        $this->assertNull($juego->getBoard()->getSlots()[1][1]); // El tablero debe estar vacío
    }

    public function testComprobarVictoria() {
        $jugador1 = new Player("Jugador 1", "red");
        $jugador2 = new Player("Jugador 2", "yellow");
        $juego = new Game($jugador1, $jugador2);

        // Realizar movimientos para ganar
        $juego->play(1);
        $juego->play(2);
        $juego->play(1);
        $juego->play(2);
        $juego->play(1);
        $juego->play(2);
        $juego->play(1); // Jugador 1 gana
        $this->assertEquals($jugador1, $juego->getWinner());
    }

    public function testJugarConIA() {
        $jugador1 = new Player("Jugador 1", "red");
        $jugador2 = new Player("IA", "yellow", true);
        $juego = new Game($jugador1, $jugador2);

        // Simular un movimiento del jugador 1
        $juego->play(1);
        // La IA debe realizar su movimiento automáticamente
        $this->assertNotNull($juego->getBoard()->getLastMove());
    }
}
?>
