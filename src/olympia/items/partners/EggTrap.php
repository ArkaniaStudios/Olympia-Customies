<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Egg;
use pocketmine\item\ItemIdentifier;

class EggTrap extends Egg implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("eggtrap_item", $creative);
        $this->setLore([
            "§rCet objet permet de faire apparaître des §etoiles§r.",
        ]);
    }

}