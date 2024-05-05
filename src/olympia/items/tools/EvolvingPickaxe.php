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
use pocketmine\item\Pickaxe;
use pocketmine\item\ToolTier;

class EvolvingPickaxe extends Pickaxe implements ItemComponents {
    use ItemComponentsTrait;

    private int $block;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, ToolTier::DIAMOND);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_PICKAXE);
        $this->initComponent("evolving_pickaxe", $creative);
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
        $this->addComponent(new HandEquippedComponent(true));
        $this->getNamedTag()->setInt("blocks", 0);
        $this->setLore(["§rNombre de block(s): §e{$this->getBlockCount()}"]);
    }

    public function getMaxDurability(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["others"]["tools"]["evolving"]["durability"];
    }

    public function getAttackPoints(): int
    {
        return Customies::getInstance()->getParameters()["items-stats"]["others"]["tools"]["evolving"]["damage"];
    }

    public function keepOnDeath(): bool {
        return true;
    }

    public function updateBlock(): self {
        $blocks = $this->getNamedTag()->getInt("blocks");
        $this->getNamedTag()->setInt("blocks", $blocks + 1);

        $enchantments = [
            199 => 2,
            499 => 3,
            999 => 5,
        ];

        foreach ($enchantments as $blocks => $levels) {
            if ($this->getBlockCount() <= $blocks) {
                $this->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), $levels));
                break;
            }
        }

        $this->setLore(["§rNombre de block(s): §e{$this->getBlockCount()}"]);

        return $this;
    }

    public function getBlockCount(): int {
        return $this->getNamedTag()->getInt("blocks");
    }
}