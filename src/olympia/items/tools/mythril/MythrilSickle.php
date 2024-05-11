<?php

namespace olympia\items\tools\mythril;

use customiesdevs\customies\item\component\DamageComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use olympia\items\Sickle;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\FireExtinguishSound;

class MythrilSickle extends Sickle implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("mythril_sickle", $creative);
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
        $this->addComponent(new HandEquippedComponent());
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->setLore([
            "§rLa faucille en §emythril §rpermet de",
            "§rlabourer la terre en §e3x3",
        ]);
    }

    public function getMaxDurability(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["mythril"]["tools"]["sickle"]["durability"];
    }

    public function getAttackPoints(): int {
        return Customies::getInstance()->getParameters()["items-stats"]["mythril"]["tools"]["sickle"]["damage"];
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult {
        $inv = $player->getInventory();
        $pos = $blockClicked->getPosition();
        $world = $pos->getWorld();

        $offset = [
            [0, 0, 0],
            [1, 0, 0],
            [-1, 0, 0],
            [0, 0, 1],
            [0, 0, -1],
            [1, 0, 1],
            [1, 0, -1],
            [-1, 0, -1],
            [-1, 0, 1]
        ];
        $crop = [
            [0, 1, 0],
            [1, 1, 0],
            [-1, 1, 0],
            [0, 1, 1],
            [0, 1, -1],
            [1, 1, 1],
            [1, 1, -1],
            [-1, 1, -1],
            [-1, 1, 1]
        ];

        foreach ($offset as $offsets) {
            $offsetsPos = $pos->add($offsets[0], $offsets[1], $offsets[2]);
            if (in_array($world->getBlock($offsetsPos)->getTypeId(), [VanillaBlocks::GRASS()->getTypeId(), VanillaBlocks::DIRT()->getTypeId()])) {
                $world->setBlock($offsetsPos, VanillaBlocks::FARMLAND());
                $player->broadcastSound(new FireExtinguishSound());
            }
        }

        foreach ($crop as $crops) {
            $cropsPos = $pos->add($crops[0], $crops[1], $crops[2]);
            $farmLandPos = $cropsPos->subtract(0, 1, 0);
            if ($world->getBlock($farmLandPos)->getTypeId() == VanillaBlocks::FARMLAND()->getTypeId()) {
                $planted = false;

                foreach ($inv->getContents() as $slot => $item) {
                    if (array_key_exists($item->getTypeId(), $this->getSeeds()) && $inv->canAddItem($this->getSeeds()[$item->getTypeId()])) {
                        $world->setBlock($cropsPos, $this->getSeeds()[$item->getTypeId()]);
                        $player->broadcastSound(new FireExtinguishSound());
                        $inv->setItem($slot, $item->setCount($item->getCount() - 1));
                        $planted = true;
                        break;
                    }
                }

                if ($planted) {
                    continue;
                }
            }
        }
        return ItemUseResult::SUCCESS();
    }
}