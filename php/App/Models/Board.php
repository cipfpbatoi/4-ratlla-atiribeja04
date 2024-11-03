<?php
namespace App\Models;

class Board {
    public const FILES = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    private ?array $lastMove = null;

    private array $slots;

    public function __construct() {
        $this->slots = self::initializeBoard();
    }

    private static function initializeBoard(): array {
        return array_fill(1, self::FILES, array_fill(1, self::COLUMNS, null));
    }

    public function getSlots(): array {
        return $this->slots;
    }

    public function getLastMove(): ?array {
        return $this->lastMove;
    }

    public function setMovementOnBoard(int $column, int $player): ?array {
        for ($row = self::FILES; $row >= 1; $row--) {
            if ($this->slots[$row][$column] === null) {
                $this->slots[$row][$column] = $player;
                $this->lastMove = [$row, $column];
                return [$row, $column];
            }
        }
        return null;
    }
    


    public function checkWin(array $coord): bool {
        [$row, $col] = $coord;
        $player = $this->slots[$row][$col];

        foreach (self::DIRECTIONS as [$dRow, $dCol]) {
            $count = 1;

            for ($i = 1; $i < 4; $i++) { 
                $r = $row + $i * $dRow;
                $c = $col + $i * $dCol;
                if ($this->isWithinBounds($r, $c) && $this->slots[$r][$c] === $player) {
                    $count++;
                } else {
                    break;
                }
            }

            for ($i = 1; $i < 4; $i++) {  
                $r = $row - $i * $dRow;
                $c = $col - $i * $dCol;
                if ($this->isWithinBounds($r, $c) && $this->slots[$r][$c] === $player) {
                    $count++;
                } else {
                    break;
                }
            }

            if ($count >= 4) {  
                return true;
            }
        }

        return false;
    }

    private function isWithinBounds(int $row, int $col): bool {
        return $row >= 1 && $row <= self::FILES && $col >= 1 && $col <= self::COLUMNS;
    }

    public function isValidMove(int $column): bool {
        return $column >= 1 && $column <= self::COLUMNS && $this->slots[1][$column] === null;
    }

    public function isFull(): bool {
        foreach ($this->slots[1] as $slot) {  
            if ($slot === null) {
                return false;
            }
        }
        return true;
    }
}