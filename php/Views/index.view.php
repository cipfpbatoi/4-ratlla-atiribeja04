<html>
<head>
    <link rel="stylesheet" href="styles/4enraya.css">
    <title>4 en Raya</title>
    <style>
        .player1 {
            background-color: <?= $players[1]->getColor() ?> ;
        }

        .player2 {
            background-color:  <?= $players[2]->getColor() ?>; 
        }

    </style>
</head>
<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/error.view.php'; ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/board.view.php'; ?>
    <input type="submit" name="reset" value="Reiniciar juego">
    <input type="submit" name="exit" value="Acabar juego"> 
</form>

    
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/panel.view.php'; ?>
</body>
</html>
        