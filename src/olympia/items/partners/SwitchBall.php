<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Snowball;
use pocketmine\player\Player;

class SwitchBall extends Snowball implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("switch_ball", $creative);
        $this->setLore([
            "§rCet objet permet d'échanger les §epositions§r de deux joueurs.",
        ]);
    }
}
