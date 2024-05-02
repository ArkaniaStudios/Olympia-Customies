<?php

namespace olympia\listeners;

use olympia\items\tools\EvolvingPickaxe;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class BlockBreak implements Listener {

    public function onBreak(BlockBreakEvent $e): void {
        $player = $e->getPlayer();
        $inv = $player->getInventory();
        $item = $inv->getItemInHand();

        if ($item instanceof EvolvingPickaxe) {
            $inv->setItem($inv->getHeldItemIndex(), $item->updateBlock());
        }
    }
}