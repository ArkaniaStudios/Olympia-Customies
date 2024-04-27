<?php

namespace olympia\items\mythril;

use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\items\Sickle;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class MythrilSickle extends Sickle implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("mythril_sickle", $creative);
        $this->addComponent(new HandEquippedComponent());
        $this->addComponent(new MaxStackSizeComponent(1));
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult {
        $this->setRadius(3);
        $pos = $blockClicked->getPosition();
        $world = $pos->getWorld();
        $offset = [
            [1, 0, 0],
            [-1, 0, 0],
            [0, 0, 1],
            [0, 0, -1],
            [1, 0, 1],
            [1, 0, -1],
            [-1, 0, -1],
            [-1, 0, 1]
        ];

        foreach ($offset as $offsets) {
            $newPos = $pos->add($offsets[0], $offsets[1], $offsets[2]);
            if (in_array($world->getBlock($newPos)->getTypeId(), [VanillaBlocks::GRASS()->getTypeId(), VanillaBlocks::DIRT()->getTypeId()])) {
                $world->setBlock($newPos, VanillaBlocks::FARMLAND());
            }
        }

        return ItemUseResult::SUCCESS();
    }
}