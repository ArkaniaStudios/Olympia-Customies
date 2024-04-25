<?php

namespace olympia\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use pocketmine\utils\SingletonTrait;

class ItemUtils {
    use SingletonTrait;

    public function register(
        string $class,
        string $identifier,
        string $name
    ): void {
        CustomiesItemFactory::getInstance()->registerItem(
            $class,
            "olympia:" . $identifier,
            $name
        );
    }
}