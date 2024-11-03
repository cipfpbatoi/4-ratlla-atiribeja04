<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 en Raya - Configurar Jugador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>4 en Raya</h1>
    <h2>Selecciona tu nombre y color</h2>

    <form action="/index.php" method="post">
        <div class="player-selection">
            <h3>Jugador 1</h3>
            <label for="player1_name">Nombre:</label>
            <input type="text" id="player1_name" name="player1_name" required>

            <label for="player1_color">Color:</label>
            <select id="player1_color" name="player1_color" required onchange="updatePlayer2ColorOptions()">
                <option value="red">Rojo</option>
                <option value="blue">Azul</option>
                <option value="green">Verde</option>
                <option value="purple">Morado</option>
                <option value="orange">Naranja</option>
            </select>
        </div>

        <div class="player-selection">
            <h3>Jugador 2</h3>
            <label>
                <input type="radio" name="player2_type" value="ia" onclick="togglePlayer2Options()" checked> IA
            </label>
            <label>
                <input type="radio" name="player2_type" value="real" onclick="togglePlayer2Options()"> Jugador Real
            </label>

            <div id="player2_options" style="display: none;">
                <label for="player2_name">Nombre:</label>
                <input type="text" id="player2_name" name="player2_name">

                <label for="player2_color">Color:</label>
                <select id="player2_color" name="player2_color">
                    <option value="red">Rojo</option>
                    <option value="blue">Azul</option>
                    <option value="green">Verde</option>
                    <option value="purple">Morado</option>
                    <option value="orange">Naranja</option>
                </select>
            </div>
        </div>

        <button type="submit">Iniciar Juego</button>
    </form>


    <script src="javascript/index.js"></script>
</body>
</html>
