<?php

namespace olympia\items\mythril;

use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class MythrilSickle extends Item implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("mythril_sickle", $creative);
        $this->addComponent(new HandEquippedComponent());
        $this->addComponent(new MaxStackSizeComponent(1));
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult {
        if ($blockClicked->getTypeId() === BlockTypeIds::FARMLAND) {

        }

        return parent::onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector, $returnedItems);
    }
}