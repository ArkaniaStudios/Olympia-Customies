<?php

namespace olympia;

use olympia\listeners\BlockBreak;
use olympia\listeners\PlayerDeath;
use olympia\listeners\PlayerItemHeld;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Customies extends PluginBase {
    use SingletonTrait;

    protected function onEnable(): void {
        $this::setInstance($this);
        Register::registerAll();
        $this->getServer()->getPluginManager()->registerEvents(new PlayerDeath(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BlockBreak(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerItemHeld(), $this);

    }
}