<?php

namespace olympia\blocks;

use customiesdevs\customies\block\permutations\Permutable;
use customiesdevs\customies\block\permutations\RotatableTrait;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;

class ChunkBuster extends Block implements Permutable {
    use RotatableTrait;

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Chunk buster", new BlockTypeInfo(new BlockBreakInfo(1)));
    }
}