<?php

namespace olympia\items\tools;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;

class InfinitySword extends Sword implements ItemComponents {
    use ItemComponentsTrait;

    private int $kill = 0;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("diamond_sword", $creative);
        $nbt = $this->getNamedTag();
        $nbt->setInt("kills", $this->kill);
        $this->setNamedTag($nbt);
    }

    public function getDamage(): int {
        return 10;
    }

    public function getMaxDurability(): int {
        return 2000;
    }

    public function keepOnDeath(): bool {
        return true;
    }

    public function updateKill(): void {
        $this->kill++;
        $nbt = $this->getNamedTag();
        $nbt->setInt("kills", $this->kill);
        $this->setNamedTag($nbt);

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
    }

    public function getKillCount(): int {
        return $this->kill;
    }
}