<?php

namespace olympia\items\tools\orichalque;

use customiesdevs\customies\item\component\DamageComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

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

    public function getMaxDurability(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["orichalque"]["tools"]["sword"]["durability"];
    }

    public function getAttackPoints(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["orichalque"]["tools"]["sword"]["damage"];
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $motion = clone $player->getMotion();
        $motion->x += $player->getDirectionVector()->getX() * 1.7;
        $motion->y += 0.8;
        $motion->z += $player->getDirectionVector()->getZ() * 1.7;
        $player->setMotion($motion);
        return ItemUseResult::SUCCESS();
    }
}