<?php

namespace olympia\blocks;

use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\Opaque;

class ChunkBuster extends Opaque {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Chunk buster", new BlockTypeInfo(new BlockBreakInfo(1)));
    }
}