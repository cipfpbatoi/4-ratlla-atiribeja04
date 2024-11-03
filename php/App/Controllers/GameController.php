<?php
namespace App\Controllers;

use App\Models\Game;
use App\Models\Player;

class GameController {
    private Game $game;

    public function __construct($request = null)
    {
        // Verifica si hay un juego guardado en la sesión
        if (isset($_SESSION['game'])) {
            $this->game = unserialize($_SESSION['game']); 
        } else {
            // Inicializa los jugadores
            $player1Name = $request['player1_name'] ?? 'Jugador 1';
            $player1Color = $request['player1_color'] ?? 'red';
            
            $player2Type = $request['player2_type'] ?? 'ia';
            if ($player2Type === 'ia') {
                $player2 = new Player('IA', 'yellow', true);
            } else {
                $player2Name = $request['player2_name'] ?? 'Jugador 2';
                $player2Color = $request['player2_color'] ?? 'blue'; 
                $player2 = new Player($player2Name, $player2Color);
            }

            // Crea un nuevo juego
            $this->game = new Game(new Player($player1Name, $player1Color), $player2);
        }

        // Juega si hay una solicitud
        if ($request) {
            $this->play($request);
        }
    }

    public function play(array $request)
    {
        // Salir del juego
        if (isset($request['exit'])) {
            $this->exitGame();
            return;
        }

        // Reiniciar el juego
        if (isset($request['reset'])) {
            $this->game->reset();
            $_SESSION['game'] = serialize($this->game);
        }

        // Realiza un movimiento en la columna seleccionada
        if (isset($request['columna'])) {
            $this->game->play($request['columna']);
        }

        // Verifica si hay un ganador
        $winner = $this->game->getWinner();

        // Guarda el estado del juego en la sesión
        $_SESSION['game'] = serialize($this->game); 

        // Carga la vista del juego
        $board = $this->game->getBoard();
        $players = $this->game->getPlayers();
        $scores = $this->game->getScores();
        $game = $this->game;
        loadView('index', compact('board', 'players', 'winner', 'scores', 'game'));
    }

    private function exitGame(): void
    {
        // Elimina la sesión y redirige
        session_unset(); 
        session_destroy(); 
        header("Location: /"); 
        exit();
    }
}
