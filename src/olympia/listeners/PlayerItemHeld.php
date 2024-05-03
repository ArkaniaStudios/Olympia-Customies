<?php

namespace olympia\listeners;

use olympia\items\tools\EvolvingPickaxe;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;

class PlayerItemHeld implements Listener {

    public function onDeath(PlayerItemHeldEvent $e): void {
        $player = $e->getPlayer();
        $inv = $player->getInventory();
        $item = $inv->getItemInHand();

        if ($item instanceof EvolvingPickaxe) {
            if ($item->getBlockCount() >= 2499) {
                $player->getEffects()->add(new EffectInstance(VanillaEffects::HASTE(), 60*9999, 2));
            }
        } else {
            $player->getEffects()->remove(VanillaEffects::HASTE());
        }
    }
}