<?php
namespace App\Utils;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerFactory {
    public static function createLogger(string $channelName): Logger {
        $logger = new Logger($channelName);

        // Handler para movimientos del juego y resultados
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/game.log', Logger::INFO));

        // Handler para errores graves o problemas de sesión
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../logs/error.log', Logger::ERROR));

        return $logger;
    }
}
