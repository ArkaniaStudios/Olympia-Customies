<?php

namespace olympia\items\others;

use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\BlockPlaceSound;

class GeneratorCobble extends Item implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("generator_cobble", $creative);
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->setLore([
            "§rCet objet permet de générer un mur de cobblestone.",
        ]);
    }

    public function getMaxStackSize(): int
    {
        return 1;
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult {
        $pos = $player->getPosition();
        for ($y = 1; $y <= $pos->y - 1; $y++) {
            $player->getWorld()->setBlock(new Vector3($pos->x, $y, $pos->z), VanillaBlocks::COBBLESTONE());
            $player->broadcastSound(new BlockPlaceSound(VanillaBlocks::COBBLESTONE()));
            $player->sendPopup(" §r§eLa Cobblestone à été placé !");
        }
        return ItemUseResult::SUCCESS();
    }
}