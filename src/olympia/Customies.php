<?php

namespace olympia;

use olympia\listeners\PlayerDeath;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Customies extends PluginBase {
    use SingletonTrait;

    public Config $cfg;

    protected function onEnable(): void {
        $this::setInstance($this);
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->saveDefaultConfig();
        Register::registerAll();
        $this->getServer()->getPluginManager()->registerEvents(new PlayerDeath(), $this);
    }
}