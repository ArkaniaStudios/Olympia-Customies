<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class DashItem extends Item implements ItemComponents {
    use ItemComponentsTrait;


    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("dash_item", $creative);
        $this->setLore([
            "§rUtilisable pour se propulsé en l'air dans une §edirection§r.",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $motion = clone $player->getMotion();
        $motion->x += $player->getDirectionVector()->getX() * 1.7;
        $motion->y += 0.8;
        $motion->z += $player->getDirectionVector()->getZ() * 1.7;
        $player->setMotion($motion);
        $player->getInventory()->setItemInHand($player->getInventory()->getItemInHand()->setCount($player->getInventory()->getItemInHand()->getCount() - 1));
        return ItemUseResult::SUCCESS();
    }
}