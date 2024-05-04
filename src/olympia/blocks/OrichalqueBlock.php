<?php

namespace olympia\blocks;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\Opaque;

class OrichalqueBlock extends Opaque {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Block en orichalque", new BlockTypeInfo(new BlockBreakInfo(1)));
    }
}