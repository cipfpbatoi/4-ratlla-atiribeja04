<?php
namespace App\Models;

use App\Models\Board;
use App\Models\Player;

class Game {
    private Board $board;
    private int $nextPlayer = 1;
    private array $players;
    private ?Player $winner = null;
    private array $scores = [1 => 0, 2 => 0];

    public function __construct(Player $jugador1, Player $jugador2) {
        $this->board = new Board();
        $this->players = [1 => $jugador1, 2 => $jugador2];
        $this->nextPlayer = 1;
        $this->winner= null;
    }

    public function reset(): void {
        $this->board = new Board();
        $this->winner = null;
        $this->nextPlayer = 1;
        $this->scores = [1 => 0, 2 => 0];
        $_SESSION['game'] = serialize($this);
    }

    public function exit(): void {
        session_unset();
        session_destroy();
    }

    public function play($columna) {
        if ($this->board->isValidMove($columna)) {
            $coord = $this->board->setMovementOnBoard($columna, $this->nextPlayer);
    
            if ($coord && $this->board->checkWin($coord)) {
                $this->winner = $this->players[$this->nextPlayer];
                return; 
            } else {
                // Cambia el turno al siguiente jugador solo si el movimiento es válido
                $this->nextPlayer = $this->nextPlayer === 1 ? 2 : 1;
    
                // Si el siguiente jugador es la IA, llama a playAutomatic
                if ($this->nextPlayer === 2 && $this->players[2]->isAutomatic()) {
                    $this->playAutomatic(); // La IA juega
                    $coord = $this->board->getLastMove();
                    
                    if ($coord && $this->board->checkWin($coord)) {
                        $this->winner = $this->players[$this->nextPlayer];
                    }
                    
                    // Al finalizar el movimiento de la IA, cambia de turno al jugador humano
                    $this->nextPlayer = 1; // Regresar el turno al jugador humano
                }
            }
        }
    }

    public function playAutomatic() {
        $opponent = $this->nextPlayer === 1 ? 2 : 1;

        // Intentar ganar
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->nextPlayer);

                if ($tempBoard->checkWin($coord)) {
                    $this->board->setMovementOnBoard($col, $this->nextPlayer); 
                    return;
                }
            }
        }

        // Intentar bloquear al oponente
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);
                if ($tempBoard->checkWin($coord)) {
                    $this->board->setMovementOnBoard($col, $this->nextPlayer); 
                    return;
                }
            }
        }

        // Seleccionar un movimiento aleatorio
        $possibles = [];
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $possibles[] = $col;
            }
        }
        
        if (count($possibles) > 0) {

            $randomIndex = array_rand($possibles);
            $this->board->setMovementOnBoard($possibles[$randomIndex], $this->nextPlayer); // Jugar en esa columna
        }

        // Cambiar al siguiente jugador
        $this->nextPlayer = $this->nextPlayer === 1 ? 2 : 1;
    }

    public function save(): void {
        $_SESSION['game'] = serialize($this);
    }

    public static function restore(): ?self {
        return isset($_SESSION['game']) ? unserialize($_SESSION['game']) : null;
    }

    // Getters
    public function getBoard(): Board {
        return $this->board;
    }

    public function getNextPlayer(): int {
        return $this->nextPlayer;
    }

    public function getPlayers(): array {
        return $this->players;
    }

    public function getWinner(): ?Player {
        return $this->winner;
    }

    public function getScores(): array {
        return $this->scores;
    }

    // Setters
    public function setBoard(Board $board): void {
        $this->board = $board;
    }

    public function setNextPlayer(int $nextPlayer): void {
        $this->nextPlayer = $nextPlayer;
    }

    public function setPlayers(array $players): void {
        $this->players = $players;
    }

    public function setWinner(?Player $winner): void {
        $this->winner = $winner;
    }

    public function setScores(array $scores): void {
        $this->scores = $scores;
    }

    public function initializePlayers($player1Name, $player1Color, $player2Name = 'Jugador 2', $player2Color = 'yellow', $player2Automatic = true) {
        $this->players[1] = new Player($player1Name, $player1Color);
        $this->players[2] = new Player($player2Name, $player2Color, $player2Automatic);
        $this->nextPlayer = 1;
        $this->board = new Board();
        $this->winner = null;
    }
}
