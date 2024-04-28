<?php

namespace olympia\items;

use pocketmine\item\Item;

class Sickle extends Item {
    private int $radius;

    public function setRadius(int $radius, int $y): array {
        $this->radius = $radius;
        
        return [
            [$y, $y, $y],
            [$radius, $y, $y],
            [-$radius, $y, $y],
            [$y, $y, $radius],
            [$y, $y, -$radius],
            [$radius, $y, $radius],
            [$radius, $y, -$radius],
            [-$radius, $y, -$radius],
            [-$radius, $y, $radius]
        ];
    }

    public function getRadius(): int {
        return $this->radius;
    }
}