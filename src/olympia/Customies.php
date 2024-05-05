<?php

namespace olympia;

use olympia\listeners\BlockBreak;
use olympia\listeners\PlayerDeath;
use olympia\listeners\PlayerItemHeld;
use olympia\recipes\CraftRecipes;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Customies extends PluginBase {
    use SingletonTrait;

    private array $cfg;

    protected function onEnable(): void {
        $this::setInstance($this);
        $this->saveDefaultConfig();
        $this->cfg = parent::getConfig()->getAll();
        Register::registerAll();
        $this->getServer()->getPluginManager()->registerEvents(new PlayerDeath(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BlockBreak(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerItemHeld(), $this);
        $craft = new CraftRecipes();
        $craft->initCraft();
    }

    public function getParameters(): array {
        return $this->cfg;

    }

}