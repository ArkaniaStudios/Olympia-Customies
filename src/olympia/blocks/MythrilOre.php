<?php

namespace olympia\blocks;

use olympia\items\OlympiaItems;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\math\Vector3;

class MythrilOre extends Block {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Minerai de mythril", new BlockTypeInfo(new BlockBreakInfo(1)));
    }

    public function onBreak(Item $item, ?Player $player = null, array &$returnedItems = []): bool
    {
        $player?->getInventory()->addItem(OlympiaItems::MYTHRIL_INGOT());
        $player?->getWorld()->dropExperience($player->getPosition(), 5);
        return parent::onBreak($item, $player, $returnedItems);
    }
}