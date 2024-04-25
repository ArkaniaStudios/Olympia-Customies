<?php

namespace olympia\items\mythril;

use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\items\Sickle;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class MythrilSickle extends Sickle implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("diamond_hoe", $creative);
        $this->addComponent(new HandEquippedComponent());
        $this->addComponent(new MaxStackSizeComponent(1));
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult {
        $this->setRadius(3);
        $xPos = $blockClicked->getPosition()->x;
        $zPos = $blockClicked->getPosition()->z;

        if ($blockClicked->getTypeId() === BlockTypeIds::FARMLAND) {
            $maxX = $xPos + $this->getRadius();
            $maxZ = $zPos + $this->getRadius();
            $minX = $xPos - $this->getRadius();
            $minZ = $zPos - $this->getRadius();

            for ($x = $minX; $x <= $maxX; $x++) {
                for ($z = $minZ; $z <= $maxZ; $z++) {

                }
            }
        }

        return parent::onInteractBlock($player, $blockReplace, $blockClicked, $face, $clickVector, $returnedItems);
    }
}