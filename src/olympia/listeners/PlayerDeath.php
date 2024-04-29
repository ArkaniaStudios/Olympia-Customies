<?php

namespace olympia\listeners;

use olympia\items\OlympiaItems;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;

class PlayerDeath implements Listener {

    public function onDeath(PlayerDeathEvent $e): void {
        $player = $e->getPlayer();
        $cause = $player->getLastDamageCause();
        $item = OlympiaItems::INFINITY_SWORD();

        if ($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if ($damager instanceof Player) {
                $inv = $damager->getInventory();
                if ($inv->getItemInHand()->getTypeId() === $item->getTypeId()) {
                    $nbt = $item->getNamedTag();
                    $kill = $nbt->getInt("kills", 1);
                    $nbt->setInt("kills", $kill + 1);
                    $item->setLore(["§rL'épée de l'infine a $kill kills"]);
                    $inv->setItem($inv->getHeldItemIndex(), $item);
                }
            }
        }
    }
}