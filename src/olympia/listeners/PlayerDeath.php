<?php

namespace olympia\listeners;

use olympia\items\tools\InfinitySword;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;

class PlayerDeath implements Listener {

    public function onDeath(PlayerDeathEvent $e): void {
        $player = $e->getPlayer();
        $cause = $player->getLastDamageCause();

        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                $inv = $damager->getInventory();
                $item = $inv->getItemInHand();
                if ($item instanceof InfinitySword) {
                    $inv->setItem($inv->getHeldItemIndex(), $item->updateKill());
                }
            }
        }
    }
}