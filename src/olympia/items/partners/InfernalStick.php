<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\EffectManager;
use pocketmine\entity\effect\SpeedEffect;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use pocketmine\world\sound\BellRingSound;

class InfernalStick extends Item implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("infernal_stick", $creative);
        $this->setLore([
            "§rCet objet permet de donné des §eeffets§r au joueur frappé.",
        ]);
    }

    public function onAttackEntity(Entity $victim, array &$returnedItems): bool
    {
        if($victim instanceof Player) {
            $victim->getEffects()->add(new EffectInstance(VanillaEffects::BLINDNESS(), 25 * 5, 5));
            $victim->getEffects()->add(new EffectInstance(VanillaEffects::SLOWNESS(), 25 * 5, 1));
            $victim->broadcastSound(new BellRingSound());
            $victim->sendPopup("§cVous avez été frappé par un §eBâton Infernal§c.");
        }
        return true;
    }
}