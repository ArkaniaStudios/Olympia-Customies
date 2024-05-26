<?php

namespace olympia\blocks;

use olympia\items\OlympiaItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class OrichalqueOre extends Block {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Minerai d'orichalque", new BlockTypeInfo(new BlockBreakInfo(1)));
    }

    public function onBreak(Item $item, ?Player $player = null, array &$returnedItems = []): bool
    {
        $player?->getInventory()->addItem(OlympiaItems::ORICHALQUE_INGOT());
        $player?->getWorld()->dropExperience($player->getPosition(), 10);
        return parent::onBreak($item, $player, $returnedItems);
    }
}