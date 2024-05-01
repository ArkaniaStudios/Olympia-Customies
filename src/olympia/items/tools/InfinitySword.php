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
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\world\sound\BellRingSound;
use pocketmine\world\sound\BucketEmptyWaterSound;
use pocketmine\world\sound\XpCollectSound;

class InfinitySword extends Sword implements ItemComponents {
    use ItemComponentsTrait;

    private int $kill;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("infinity_sword", $creative);
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
        $this->getNamedTag()->setInt("kills", 0);
        $this->setLore(["§rNombre de kill(s): §e{$this->getKillCount()}"]);
        $this->addComponent(new HandEquippedComponent(true));
    }

    public function getAttackPoints(): int {
        return 10;
    }

    public function getMaxDurability(): int {
        return 2000;
    }

    public function keepOnDeath(): bool {
        return true;
    }

    public function updateKill(): self {
        $kill = $this->getNamedTag()->getInt("kills");
        $this->getNamedTag()->setInt("kills", $kill + 1);
        $player->broadcastSound(new XpCollectSound());

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
}