<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use olympia\utils\PlayerCooldowns;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Entity;
use pocketmine\item\Egg;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use pocketmine\world\sound\BellRingSound;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;

class EggTrap extends Egg implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("eggtrap_item", $creative);
        $this->setLore([
            "§rCet objet permet de faire apparaître des §étoiles§r.",
        ]);
    }


    private function removeCobwebs(array $positions, Player $victim): void {
        $world = $victim->getWorld();
        foreach ($positions as $pos) {
            $block = $world->getBlockAt($pos[0], $pos[1], $pos[2]);
            if ($block->getName() === VanillaBlocks::COBWEB()->getName()) {
                $world->setBlock(new Vector3($pos[0], $pos[1], $pos[2]), VanillaBlocks::AIR());
            }
        }
    }

    public function onAttackEntity(Entity $victim, array &$returnedItems): bool {
        if ($victim instanceof Player) {
            $cooldowns = new PlayerCooldowns($victim);
            $cooldownId = PlayerCooldowns::COOLDOWN_EGGSTRAP;

            if (!$cooldowns->hasCooldown($cooldownId)) {
                $world = $victim->getWorld();
                $position = $victim->getPosition();
                $x = intval($position->x);
                $y = intval($position->y);
                $z = intval($position->z);

                $positions = [];
                for ($i = $x - 1; $i <= $x + 1; $i++) {
                    for ($j = $z - 1; $j <= $z + 1; $j++) {
                        $positions[] = [$i, $y, $j];
                        $positions[] = [$i, $y + 1, $j];
                    }
                }

                foreach ($positions as $pos) {
                    $block = $world->getBlockAt(intval($pos[0]), intval($pos[1]), intval($pos[2]));
                    if ($block->getName() === VanillaBlocks::AIR()->getName()) {
                        $world->setBlock(new Vector3($pos[0], $pos[1], $pos[2]), VanillaBlocks::COBWEB());
                    }
                }

                $victim->broadcastSound(new BellRingSound());
                $victim->sendPopup("§cVous avez été frappé par un §eEggTrap§c.");

                // Schedule the removal of cobwebs after 10 seconds
                Customies::getInstance()->getScheduler()->scheduleDelayedTask(new class($positions, $victim) extends Task {
                    private array $positions;
                    private Player $victim;

                    public function __construct(array $positions, Player $victim) {
                        $this->positions = $positions;
                        $this->victim = $victim;
                    }

                    public function onRun(): void
                    {
                        $this->removeCobwebs($this->positions, $this->victim);
                    }

                    private function removeCobwebs(array $positions, Player $victim): void {
                        $world = $victim->getWorld();
                        foreach ($positions as $pos) {
                            $block = $world->getBlockAt(intval($pos[0]), intval($pos[1]), intval($pos[2]));
                            if ($block->getName() === VanillaBlocks::COBWEB()->getName()) {
                                $world->setBlock(new Vector3($pos[0], $pos[1], $pos[2]), VanillaBlocks::AIR());
                            }
                        }
                    }
                }, 20 * 10);

                $cooldowns->setCooldown($cooldownId, 16);

                return true;
            } else {
                $victim->sendMessage("§cPatientiez !");

                return false;
            }
        }
        return false;
    }
}