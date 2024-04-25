<?php

namespace olympia\items;

use pocketmine\item\Item;

class Sickle extends Item {
    private int $radius;

    public function setRadius(int $radius): void {
        $this->radius = $radius;
    }

    public function getRadius(): int {
        return $this->radius;
    }
}