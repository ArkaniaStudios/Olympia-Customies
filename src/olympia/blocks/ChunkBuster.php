<?php

namespace olympia\blocks;

use olympia\forms\FormManager;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class ChunkBuster extends Block {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockTypeIds::newId()), "Chunk buster", new BlockTypeInfo(new BlockBreakInfo(1)));
    }

    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null, array &$returnedItems = []): bool {
        $form = new FormManager();
        $form->chunkBusterValidation($player);

        return true;
    }
}