<?php

namespace olympia\items;

use pocketmine\item\Item;
use pocketmine\math\Vector3;

class Sickle extends Item {
    private int $radius;

    public function setRadius(int $radius, int $y): array {
        $this->radius = $radius;
        
        return [
            new Vector3($y, $y, $y),
            new Vector3($radius, $y, $y),
            new Vector3(-$radius, $y, $y),
            new Vector3($y, $y, $radius),
            new Vector3($y, $y, -$radius),
            new Vector3($radius, $y, $radius),
            new Vector3($radius, $y, -$radius),
            new Vector3(-$radius, $y, -$radius),
            new Vector3(-$radius, $y, $radius)
        ];
    }

    public function getRadius(): int {
        return $this->radius;
    }
}