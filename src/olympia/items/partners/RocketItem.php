<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use olympia\utils\Cooldown;

class RocketItem extends Item implements ItemComponents {
    use ItemComponentsTrait;


    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("rocket_item", $creative);
        $this->setLore([
            "§rUtilisable pour se propulsé en l'air de §e50§r blocs.",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $motion = clone $player->getMotion();
        $motion->y += 0.069 * Customies::getInstance()->getParameters()["items-stats"]["others"]["partners"]["rocket"]["blocks"];
        $player->setMotion($motion);
        $player->getInventory()->setItemInHand($player->getInventory()->getItemInHand()->setCount($player->getInventory()->getItemInHand()->getCount() - 1));
        return ItemUseResult::SUCCESS();
    }
}