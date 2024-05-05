<?php

namespace olympia\items\armors\orichalque;

use customiesdevs\customies\item\component\ArmorComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\component\WearableComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\ItemIdentifier;

class OrichalqueBoots extends Armor implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name, new ArmorTypeInfo(6, 992, ArmorInventory::SLOT_FEET));
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_BOOTS);
        $this->initComponent("orichalque_boots", $creative);
        $this->addComponent(new WearableComponent(WearableComponent::SLOT_ARMOR_FEET, 6));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new ArmorComponent(6, textureType: "diamond"));
        $this->addComponent(new DurabilityComponent(992));
        $this->setLore([
            "§rCes bottes en orichalque sont plus §epuissantes §rque le",
            "§emythril§r, néanmoins elles ne sont pas les puissantes !",
        ]);
    }

    public function getMaxDurability(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["orichalque"]["armors"]["boots"]["durability"];
    }

    public function getDefensePoints(): int
    {
        return Customies::getInstance()->getParameters()["items-stats"]["orichalque"]["armors"]["boots"]["protection"];
    }
}