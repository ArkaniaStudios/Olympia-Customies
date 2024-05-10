<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Entity;
use pocketmine\item\Egg;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use pocketmine\world\sound\BellRingSound;
use pocketmine\math\Vector3;

class EggTrap extends Egg implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("eggtrap_item", $creative);
        $this->setLore([
            "§rCet objet permet de faire apparaître des §etoiles§r.",
        ]);
    }

    // temporary system
    public function onAttackEntity(Entity $victim, array &$returnedItems): bool
    {
        if($victim instanceof Player) {
            $world = $victim->getWorld();
            $position = $victim->getPosition();
            $positions = [
                [$position->x, $position->y, $position->z],
                [$position->x + 1, $position->y, $position->z],
                [$position->x - 1, $position->y, $position->z],
                [$position->x, $position->y, $position->z + 1],
                [$position->x, $position->y, $position->z - 1],
                [$position->x + 1, $position->y, $position->z + 1],
                [$position->x - 1, $position->y, $position->z - 1],
                [$position->x + 1, $position->y, $position->z - 1],
                [$position->x - 1, $position->y, $position->z + 1],
            ];

            foreach ($positions as $pos) {
                $world->setBlock(new Vector3($pos[0], $pos[1], $pos[2]), VanillaBlocks::COBWEB());
            }

            $victim->broadcastSound(new BellRingSound());
            $victim->sendPopup("§cVous avez été frappé par un §eEggTrap§c.");
        }
        return true;
    }

}