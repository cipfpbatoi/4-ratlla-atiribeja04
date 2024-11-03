<?php
namespace App\Models;

class Player {
    private string $name;
    private string $color;
    private bool $isAutomatic;

    public function __construct(string $name, string $color, bool $isAutomatic = false) {
        $this->name = $name;
        $this->color = $color;
        $this->isAutomatic = $isAutomatic;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function isAutomatic(): bool {
        return $this->isAutomatic;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setColor(string $color): void {
        $this->color = $color;
    }

    public function setAutomatic(bool $isAutomatic): void {
        $this->isAutomatic = $isAutomatic;
    }
}
