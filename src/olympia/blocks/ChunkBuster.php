<?php

namespace olympia\blocks;

use customiesdevs\customies\block\permutations\Permutable;
use customiesdevs\customies\block\permutations\RotatableTrait;
use pocketmine\block\Block;

class ChunkBuster extends Block implements Permutable {
    use RotatableTrait;
}