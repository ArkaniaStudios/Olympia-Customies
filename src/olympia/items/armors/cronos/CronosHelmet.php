<?php

namespace olympia\items\armors\cronos;

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

class CronosHelmet extends Armor implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, new ArmorTypeInfo(6, 992, ArmorInventory::SLOT_HEAD));
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_HELMET);
        $this->initComponent("cronos_helmet", $creative);
        $this->addComponent(new WearableComponent(WearableComponent::SLOT_ARMOR_HEAD));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new ArmorComponent(6, textureType: "diamond"));
        $this->addComponent(new DurabilityComponent(992));
        $this->setLore([
            "§rCe casque en cronos est plus §epuissant §rque le",
            "§eorichalque§r !",
        ]);
    }

    public function getMaxDurability(): int {
        return 992;
    }
}