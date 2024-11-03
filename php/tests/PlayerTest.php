<?php
namespace App\Models;

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase {
    public function testCrearJugador() {
        $jugador = new Player("Jugador 1", "red", false);
        $this->assertEquals("Jugador 1", $jugador->getName());
        $this->assertEquals("red", $jugador->getColor());
        $this->assertFalse($jugador->isAutomatic());
    }

    public function testCambiarNombre() {
        $jugador = new Player("Jugador 1", "red");
        $jugador->setName("Nuevo Nombre");
        $this->assertEquals("Nuevo Nombre", $jugador->getName());
    }

    public function testCambiarColor() {
        $jugador = new Player("Jugador 1", "red");
        $jugador->setColor("blue");
        $this->assertEquals("blue", $jugador->getColor());
    }

    public function testCambiarAutomatico() {
        $jugador = new Player("Jugador 1", "red", false);
        $jugador->setAutomatic(true);
        $this->assertTrue($jugador->isAutomatic());
    }
}
?>
