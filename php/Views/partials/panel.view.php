<div class="game-panel">
    <h3>Información del juego</h3>
    <p>Jugador 1: <?= $players[1]->getName(); ?> (Color: <?= $players[1]->getColor(); ?>)</p>
    <p>Jugador 2: <?= $players[2]->getName(); ?> (Color: <?= $players[2]->getColor(); ?>)</p>
    
    <?php if ($winner): ?>
        <h4>¡Ganador: <?= $winner->getName(); ?>!</h4>
    <?php else: ?>
        <p>Turno del jugador: <?= $players[$game->getNextPlayer()]->getName(); ?></p>
    <?php endif; ?>
</div>
