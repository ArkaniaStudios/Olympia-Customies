<?php

namespace olympia\blocks;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;

class OrichalqueOre extends Block {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Minerai d'orichalque", new BlockTypeInfo(new BlockBreakInfo(1)));
    }
}