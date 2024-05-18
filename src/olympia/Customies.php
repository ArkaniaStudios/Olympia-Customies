<?php

namespace olympia;

use olympia\listeners\ArmorEffects;
use olympia\listeners\BlockBreak;
use olympia\listeners\PlayerDeath;
use olympia\listeners\PlayerItemHeld;
use olympia\listeners\PlayerListener;
use olympia\recipes\CraftRecipes;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\StringToEffectParser;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\inventory\ArmorInventory;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Customies extends PluginBase implements Listener {
    use SingletonTrait;

    private array $cfg;

    private const EFFECT_MAX_DURATION = 2147483647;

    private static Config $config;

    public static function getData(): Config
    {
        return self::$config;
    }


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

        @mkdir($this->getDataFolder());

        if (!file_exists($this->getDataFolder() . "armors.yml")) {
            $this->saveResource('armors.yml');
        }

        self::$config = new Config($this->getDataFolder() . 'armors.yml', Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function getParameters(): array {
        return $this->cfg;

    }

    private function addEffects(Player $player, Item $sourceItem, Item $targetItem): void
    {
        $configs = $this->getData()->getAll();
        $names = array_keys($configs);

        $nameOfSourceItem = StringToItemParser::getInstance()->lookupAliases($sourceItem);
        if (isset($nameOfSourceItem[0])) {
            $nameOfSourceItem = $nameOfSourceItem[0];
            if (in_array($nameOfSourceItem, $names)) {
                $array = $this->getData()->getAll()[$nameOfSourceItem];
                $effects = $array["effects"];

                foreach ($effects as $effectname => $arrayeffect) {
                    $effect = StringToEffectParser::getInstance()->parse($effectname);
                    $player->getEffects()->remove($effect);
                }
            }
        }

        $nameOfTargetItem = StringToItemParser::getInstance()->lookupAliases($targetItem);
        if (isset($nameOfTargetItem[0])) {
            $nameOfTargetItem = $nameOfTargetItem[0];
            if (in_array($nameOfTargetItem, $names)) {
                $array = $this->getData()->getAll()[$nameOfTargetItem];
                if ($array["message"] != null) {
                    $player->sendMessage($array["message"]);
                }
                $effects = $array["effects"];

                foreach ($effects as $effectname => $arrayeffect) {
                    $effect = StringToEffectParser::getInstance()->parse($effectname);
                    if (!is_null($effect)) {
                        $eff = new EffectInstance(
                            $effect,
                            self::EFFECT_MAX_DURATION,
                            (int)$arrayeffect["amplifier"],
                            (bool)$arrayeffect["visible"]
                        );
                        $player->getEffects()->add($eff);
                    }
                }
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        foreach ($player->getArmorInventory()->getContents() as $targetItem) {
            if ($targetItem instanceof Armor) {
                $slot = $targetItem->getArmorSlot();
                $sourceItem = $player->getArmorInventory()->getItem($slot);

                $this->addEffects($player, $sourceItem, $targetItem);
            } else {
                $this->addEffects($player, VanillaItems::AIR(), $targetItem);
            }
        }
    }

    public function onUse(PlayerItemUseEvent $event): void
    {
        $player = $event->getPlayer();
        $targetItem = $event->getItem();

        if ($targetItem instanceof Armor) {
            $slot = $targetItem->getArmorSlot();
            $sourceItem = $player->getArmorInventory()->getItem($slot);

            if (!$event->isCancelled()) {
                $this->addEffects($player, $sourceItem, $targetItem);
            }
        }
    }

    public function onArmor(InventoryTransactionEvent $event): void
    {
        $transaction = $event->getTransaction();
        $player = $transaction->getSource();

        foreach ($transaction->getActions() as $action) {
            if ($action instanceof SlotChangeAction) {
                if ($action->getInventory() instanceof ArmorInventory) {
                    $sourceItem = $action->getSourceItem();
                    $targetItem = $action->getTargetItem();

                    if (!$event->isCancelled()) {
                        $this->addEffects($player, $sourceItem, $targetItem);
                        return;
                    }
                }
            }
        }
    }


}