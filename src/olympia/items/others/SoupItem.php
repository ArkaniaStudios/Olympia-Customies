<?php

namespace olympia\items\others;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\GameMode;
use pocketmine\player\Player;


class SoupItem extends Item implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("soup_item", $creative);
        $this->setLore([
            "§rUtilisable pour récupérer de la §evie§r.",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {;
        $gameMode = $player->getGamemode();
        if(!$gameMode->equals(GameMode::SURVIVAL()) && !$gameMode->equals(GameMode::ADVENTURE())) {
            return ItemUseResult::FAIL();
        }

        $health = $player->getHealth();
        $maxHealth = $player->getMaxHealth();
        if ($health >= $maxHealth) {
            return ItemUseResult::FAIL();
        }

        $player->getInventory()->setItemInHand($player->getInventory()->getItemInHand()->setCount($player->getInventory()->getItemInHand()->getCount() - 1));
        $player->setHealth($health + 2);

        $player->sendPopup("§c+1");
        return ItemUseResult::SUCCESS();
    }
}