<?php

namespace olympia\items\tools;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\entity\Entity;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class InfinitySword extends Sword implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("diamond_sword", $creative);
    }

    public function getDamage(): int {
        return 10;
    }

    public function getMaxDurability(): int {
        return 2000;
    }

    //public function onInteractEntity(Player $player, Entity $entity, Vector3 $clickVector): bool {
    //    if ($entity instanceof  $player) {
//
    //    }
    //    return false;
    //}
}