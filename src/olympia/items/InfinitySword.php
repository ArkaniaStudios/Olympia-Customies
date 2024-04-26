<?php

namespace olympia\items;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;

class InfinitySword extends Sword implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name, ToolTier $tier, array $enchantmentTags = []) {
        parent::__construct($identifier, $name, ToolTier::DIAMOND(), $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("diamond_sword", $creative);
    }

    public function getDamage(): int {
        return parent::getDamage();
    }

    public function getMaxDurability(): int {
        return parent::getMaxDurability();
    }
}