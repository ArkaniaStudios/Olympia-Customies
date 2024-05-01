<?php

namespace olympia\items\tools\orichalque;

use customiesdevs\customies\item\component\DamageComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;

class OrichalqueSword extends Sword implements ItemComponents {
    use ItemComponentsTrait;

    private int $kill;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("orichalque_sword", $creative);
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
        $this->addComponent(new HandEquippedComponent(true));
    }

    public function getAttackPoints(): int {
        return 9;
    }

    public function getMaxDurability(): int {
        return 2000;
    }
}