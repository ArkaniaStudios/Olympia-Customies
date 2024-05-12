<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\math\Vector3;

class FishKnockback extends Item implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("fish_knockback", $creative);
        $this->addEnchantment(new EnchantmentInstance(VanillaEnchantments::KNOCKBACK(), 5));
        $this->addComponent(new DurabilityComponent(1));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->setLore([
            "§rCet objet possède l'enchetement §eKnockback V§r.",
        ]);
    }

    public function getMaxStackSize(): int
    {
        return 1;
    }

    public function getMaxDurability(): int
    {
        return 1;
    }
}