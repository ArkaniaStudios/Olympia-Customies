<?php

namespace olympia\items\tools;

use customiesdevs\customies\item\component\DamageComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\player\Player;
use pocketmine\math\Vector3;

class InfinitySword extends Sword implements ItemComponents {
    use ItemComponentsTrait;

    private int $kill;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("infinity_sword", $creative);
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
        $this->addComponent(new HandEquippedComponent(true));
        $this->getNamedTag()->setInt("kills", 0);
        $this->setLore(["§rNombre de kill(s): §e{$this->getKillCount()}"]);
    }

    public function getMaxDurability(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["others"]["tools"]["infinity"]["durability"];
    }

    public function getAttackPoints(): int
    {
        return Customies::getInstance()->getParameters()["items-stats"]["others"]["tools"]["infinity"]["damage"];
    }

    public function keepOnDeath(): bool {
        return true;
    }

    public function updateKill(): self {
        $kill = $this->getNamedTag()->getInt("kills");
        $this->getNamedTag()->setInt("kills", $kill + 1);

        $enchantments = [
            10 => 1,
            25 => 2,
            50 => 3,
            100 => 4,
            300 => 5
        ];

        foreach ($enchantments as $kills => $levels) {
            if ($this->getKillCount() <= $kills) {
                $this->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), $levels));
                break;
            }
        }

        $this->setLore(["§rNombre de kill(s): §e{$this->getKillCount()}"]);

        return $this;
    }

    public function getKillCount(): int {
        return $this->getNamedTag()->getInt("kills");
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