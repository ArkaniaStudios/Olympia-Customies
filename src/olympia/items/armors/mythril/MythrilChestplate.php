<?php

namespace olympia\items\armors\mythril;

use customiesdevs\customies\item\component\ArmorComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\component\WearableComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class MythrilChestplate extends Armor implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, new ArmorTypeInfo(6, 992, ArmorInventory::SLOT_CHEST));
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_CHESTPLATE);
        $this->initComponent("mythril_chestplate", $creative);
        $this->addComponent(new WearableComponent(WearableComponent::SLOT_ARMOR_CHEST));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new ArmorComponent(6, textureType: "diamond"));
        $this->addComponent(new DurabilityComponent(992));
        $this->setupRenderOffsets(16, 16, false);
        $this->setLore([
            "§rCe plastron en mythril est plus §epuissant §rque le",
            "§ediamant§r, néanmoins il n'est pas le plus puissant !",
        ]);
    }

    public function getMaxDurability(): int {
        return 992;
    }
}